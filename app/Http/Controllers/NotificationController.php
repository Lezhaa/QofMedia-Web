<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Jumlah notifikasi belum dibaca (badge polling)
     * Accessible: semua (auth + guest)
     */
    public function unreadCount(Request $request)
    {
        $readIds = $this->guestReadIds($request);

        if (auth()->check()) {
            $count = Notification::forUser(auth()->id())
                ->where(function ($q) use ($readIds) {
                    $q->where(function ($q2) {
                        // Notif personal belum dibaca di DB
                        $q2->whereNotNull('user_id')->where('is_read', false);
                    })->orWhere(function ($q2) use ($readIds) {
                        // Notif broadcast belum di-klik (cookie)
                        $q2->whereNull('user_id')
                           ->whereNotIn('id', count($readIds) ? $readIds : [0]);
                    });
                })
                ->count();
        } else {
            // Guest: hanya hitung broadcast yg belum dibaca (cookie)
            $count = Notification::whereNull('user_id')
                ->whereNotIn('id', count($readIds) ? $readIds : [0])
                ->count();
        }

        return response()->json(['count' => $count]);
    }

    /**
     * Daftar notifikasi untuk dropdown
     * Accessible: semua (auth + guest)
     *   - Auth  → notif personal miliknya + semua broadcast
     *   - Guest → hanya broadcast (user_id null)
     */
    public function index(Request $request)
    {
        $readIds = $this->guestReadIds($request);

        if (auth()->check()) {
            $items = Notification::forUser(auth()->id())
                ->latest()
                ->take(20)
                ->get()
                ->map(function ($n) use ($readIds) {
                    if (is_null($n->user_id)) {
                        $n->is_read = in_array($n->id, $readIds);
                    }
                    return $n;
                });
        } else {
            // Guest hanya lihat broadcast
            $items = Notification::whereNull('user_id')
                ->latest()
                ->take(20)
                ->get()
                ->map(function ($n) use ($readIds) {
                    $n->is_read = in_array($n->id, $readIds);
                    return $n;
                });
        }

        return response()->json($items->values());
    }

    /**
     * Tandai satu notifikasi dibaca
     * Accessible: semua (auth + guest) — tidak butuh auth middleware
     * karena notif broadcast juga perlu bisa ditandai oleh guest
     */
    public function markRead(Request $request, $id)
    {
        $notification = Notification::find($id);

        // Notifikasi tidak ditemukan → tetap return ok (idempoten)
        if (! $notification) {
            return response()->json(['ok' => true]);
        }

        $response = response()->json(['ok' => true]);

        // Notif personal milik user yang sedang login → update DB
        if (auth()->check() && (int) $notification->user_id === (int) auth()->id()) {
            $notification->update(['is_read' => true]);
        }

        // Notif broadcast → simpan id di cookie (berlaku untuk user & guest)
        if (is_null($notification->user_id)) {
            $readIds   = $this->guestReadIds($request);
            $readIds[] = (int) $id;
            $response  = $response->cookie(
                'notif_read',
                json_encode(array_unique($readIds)),
                60 * 24 * 30  // 30 hari
            );
        }

        return $response;
    }

    /**
     * Tandai semua notifikasi dibaca
     * Accessible: auth only
     */
    public function markAllRead(Request $request)
    {
        if (auth()->check()) {
            Notification::where('user_id', auth()->id())
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        // Update cookie untuk semua broadcast
        $broadcastIds = Notification::whereNull('user_id')->pluck('id')->toArray();
        $merged       = array_unique(array_merge($this->guestReadIds($request), $broadcastIds));

        return response()->json(['ok' => true])
            ->cookie('notif_read', json_encode($merged), 60 * 24 * 30);
    }

    /**
     * Ambil array ID broadcast yang sudah dibaca dari cookie
     */
    private function guestReadIds(Request $request): array
    {
        $cookie = $request->cookie('notif_read');
        if (! $cookie) return [];
        $decoded = json_decode($cookie, true);
        return is_array($decoded) ? array_map('intval', $decoded) : [];
    }
}