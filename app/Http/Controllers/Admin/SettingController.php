<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            // General
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_cta_text' => 'nullable|string|max:100',
            'hero_cta_url' => 'nullable|string|max:255',
            
            // Contact
            'whatsapp_studio' => 'nullable|string|max:20',
            'whatsapp_apparel' => 'nullable|string|max:20',
            'email_contact' => 'nullable|email|max:255',
            'google_maps' => 'nullable|string',
            
            // Social Media
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            
            // Site Identity
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_keywords' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:1024',
            
            // Footer
            'footer_text' => 'nullable|string|max:255',
            'footer_copyright' => 'nullable|string|max:255',
        ]);
        
        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            $validated['site_logo'] = $logoPath;
        }
        
        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            $validated['site_favicon'] = $faviconPath;
        }
        
        // Save all settings
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan website berhasil diperbarui');
    }
}