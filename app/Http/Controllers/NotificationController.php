<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Jumlah notifikasi belum dibaca (untuk polling badge)
     */
    public function unreadCount(Request $request)
    {
        $readIds = $this->guestReadIds($request);

        if (auth()->check()) {
            $count = Notification::forUser(auth()->id())
                ->where(function ($q) use ($readIds) {
                    // Notif personal belum dibaca di DB
                    $q->where(function ($q2) {
                        $q2->whereNotNull('user_id')->where('is_read', false);
                    })
                    // Notif broadcast belum ada di cookie
                    ->orWhere(function ($q2) use ($readIds) {
                        $q2->whereNull('user_id')
                           ->whereNotIn('id', count($readIds) ? $readIds : [0]);
                    });
                })
                ->count();
        } else {
            // Guest: hanya hitung broadcast yang belum ada di cookie
            $count = Notification::whereNull('user_id')
                ->whereNotIn('id', count($readIds) ? $readIds : [0])
                ->count();
        }

        return response()->json(['count' => $count]);
    }

    /**
     * Daftar notifikasi terbaru (untuk dropdown)
     */
    public function index(Request $request)
    {
        $readIds = $this->guestReadIds($request);

        if (auth()->check()) {
            $items = Notification::forUser(auth()->id())
                ->latest()
                ->take(15)
                ->get()
                ->map(function ($n) use ($readIds) {
                    // Broadcast: status baca dari cookie
                    if (is_null($n->user_id)) {
                        $n->is_read = in_array($n->id, $readIds);
                    }
                    return $n;
                });
        } else {
            $items = Notification::whereNull('user_id')
                ->latest()
                ->take(15)
                ->get()
                ->map(function ($n) use ($readIds) {
                    $n->is_read = in_array($n->id, $readIds);
                    return $n;
                });
        }

        return response()->json($items);
    }

    /**
     * Tandai satu notifikasi dibaca
     */
    public function markRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $response = response()->json(['ok' => true]);

        // Notif personal milik user yang login → update DB
        if (auth()->check() && $notification->user_id === auth()->id()) {
            $notification->update(['is_read' => true]);
        }

        // Notif broadcast → simpan id di cookie (berlaku user & guest)
        if (is_null($notification->user_id)) {
            $readIds   = $this->guestReadIds($request);
            $readIds[] = (int) $id;
            $response  = $response->cookie('notif_read', json_encode(array_unique($readIds)), 60 * 24 * 30);
        }

        return $response;
    }

    /**
     * Tandai semua notifikasi dibaca
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
        $existingIds  = $this->guestReadIds($request);
        $merged       = array_unique(array_merge($existingIds, $broadcastIds));

        return response()->json(['ok' => true])
            ->cookie('notif_read', json_encode($merged), 60 * 24 * 30);
    }

    /**
     * Helper: ambil ID broadcast yang sudah dibaca dari cookie
     */
    private function guestReadIds(Request $request): array
    {
        $cookie = $request->cookie('notif_read');
        if (!$cookie) return [];
        $decoded = json_decode($cookie, true);
        return is_array($decoded) ? array_map('intval', $decoded) : [];
    }
}