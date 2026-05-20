<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            // General
            'hero_title'       => 'nullable|string|max:255',
            'hero_subtitle'    => 'nullable|string|max:255',
            'hero_cta_text'    => 'nullable|string|max:100',
            'hero_cta_url'     => 'nullable|string|max:255',

            // Contact
            'whatsapp_studio'  => 'nullable|string|max:20',
            'whatsapp_apparel' => 'nullable|string|max:20',
            'email_contact'    => 'nullable|email|max:255',
            'google_maps'      => 'nullable|string',

            // Social Media
            'facebook'         => 'nullable|url|max:255',
            'instagram'        => 'nullable|url|max:255',
            'twitter'          => 'nullable|url|max:255',
            'tiktok'           => 'nullable|url|max:255',
            'youtube'          => 'nullable|url|max:255',

            // Site Identity
            'site_name'        => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_keywords'    => 'nullable|string|max:255',
            'site_logo'        => 'nullable|image|max:2048',
            'site_favicon'     => 'nullable|image|max:1024',

            // Footer
            'footer_text'      => 'nullable|string|max:255',
            'footer_copyright' => 'nullable|string|max:255',
        ]);

        // ── Daftar key teks biasa (bukan file) ──────────────────────────
        $textKeys = [
            'hero_title', 'hero_subtitle', 'hero_cta_text', 'hero_cta_url',
            'whatsapp_studio', 'whatsapp_apparel', 'email_contact', 'google_maps',
            'facebook', 'instagram', 'twitter', 'tiktok', 'youtube',
            'site_name', 'site_description', 'site_keywords',
            'footer_text', 'footer_copyright',
        ];

        // ── Simpan semua field teks (termasuk yang dikosongkan) ──────────
        // Bug sebelumnya: nilai null dilewati sehingga data lama tidak pernah terhapus.
        // Perbaikan: selalu updateOrCreate, simpan string kosong jika field dikosongkan.
        foreach ($textKeys as $key) {
            Setting::updateOrCreate(
                ['key'   => $key],
                ['value' => $request->input($key, '')]
            );
        }

        // ── Handle logo upload ───────────────────────────────────────────
        // Hanya update jika ada file baru; jika tidak ada, biarkan nilai lama.
        if ($request->hasFile('site_logo')) {
            // Hapus file lama dari storage
            $oldLogo = Setting::where('key', 'site_logo')->value('value');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $logoPath = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key'   => 'site_logo'],
                ['value' => $logoPath]
            );
        }

        // ── Handle favicon upload ────────────────────────────────────────
        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::where('key', 'site_favicon')->value('value');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key'   => 'site_favicon'],
                ['value' => $faviconPath]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}