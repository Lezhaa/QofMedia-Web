<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index(Album $album)
    {
        $items = $album->items()->latest()->paginate(24);
        return view('admin.gallery.items.index', compact('album', 'items'));
    }

    public function create(Album $album)
    {
        return view('admin.gallery.items.create', compact('album'));
    }

    public function store(Request $request, Album $album)
    {
         // DEBUG 1: Cek apakah method ini dipanggil
    \Log::info('GalleryItemController@store dipanggil');
    
    // DEBUG 2: Cek semua data request
    \Log::info('Request data:', $request->all());
    
    // DEBUG 3: Cek apakah ada file
    \Log::info('Has file?', ['has_file' => $request->hasFile('file')]);

        $validated = $request->validate([
            'type' => 'required|in:foto,video',
            'caption' => 'nullable|string|max:255',
            'file' => 'required|file|max:20480',
        ]);
        
        try {
            // Batasi maksimal 100 item per album
            if ($album->items()->count() >= 100) {
                return back()->with('error', 'Album sudah mencapai batas maksimal 100 item.');
            }
            
            $file = $request->file('file');
            $path = $file->store('gallery/' . $album->id, 'public');
            
            GalleryItem::create([
                'album_id' => $album->id,
                'file_path' => $path,
                'type' => $validated['type'],
                'caption' => $validated['caption'],
                'file_size' => $file->getSize(),
            ]);
            
            return redirect()->route('admin.albums.items.index', $album)
                ->with('success', 'Item berhasil diupload');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Upload gagal: ' . $e->getMessage());
        }
    }

    public function destroy(Album $album, GalleryItem $item)
    {
        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }
        $item->delete();
        
        return redirect()->route('admin.albums.items.index', $album)
            ->with('success', 'Item berhasil dihapus');
    }
    
    public function uploadMultiple(Request $request, Album $album)
    {
        $request->validate([
            'files.*' => 'required|file|max:20480',
            'type' => 'required|in:foto,video',
        ]);
        
        $files = $request->file('files');
        $type = $request->type;
        $uploaded = 0;
        
        foreach ($files as $file) {
            // Cek batas album
            if ($album->items()->count() >= 100) {
                break;
            }
            
            try {
                $path = $file->store('gallery/' . $album->id, 'public');
                
                GalleryItem::create([
                    'album_id' => $album->id,
                    'file_path' => $path,
                    'type' => $type,
                ]);
                
                $uploaded++;
            } catch (\Exception $e) {
                continue;
            }
        }
        
        return redirect()->route('admin.albums.items.index', $album)
            ->with('success', $uploaded . ' item berhasil diupload');
    }
}