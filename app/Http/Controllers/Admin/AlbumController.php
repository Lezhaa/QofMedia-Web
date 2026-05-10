<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('items')->latest()->paginate(10);
        return view('admin.gallery.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Cegah nama+tahun yang sama
                Rule::unique('albums')->where(fn($q) => $q->where('year', $request->year)),
            ],
            'year'        => 'required|integer|min:2000|max:2099',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:5120',
        ], [
            'name.unique' => 'Album dengan nama dan tahun yang sama sudah ada.',
        ]);

        // Generate slug, auto-suffix jika bentrok
        $slug = $this->generateUniqueSlug($request->name, $request->year);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('albums/covers', 'public');
        }

        Album::create([
            'name'        => $request->name,
            'year'        => $request->year,
            'description' => $request->description,
            'cover_image' => $coverPath,
            'slug'        => $slug,
        ]);

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album berhasil ditambahkan');
    }

    public function edit(Album $album)
    {
        return view('admin.gallery.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Abaikan album yang sedang diedit
                Rule::unique('albums')->where(fn($q) => $q->where('year', $request->year))
                                      ->ignore($album->id),
            ],
            'year'        => 'required|integer|min:2000|max:2099',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ], [
            'name.unique' => 'Album dengan nama dan tahun yang sama sudah ada.',
        ]);

        // Generate slug baru, abaikan slug milik album ini sendiri
        $slug = $this->generateUniqueSlug($request->name, $request->year, $album->id);

        $coverPath = $album->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($album->cover_image) {
                \Storage::disk('public')->delete($album->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('albums/covers', 'public');
        }

        $album->update([
            'name'        => $request->name,
            'year'        => $request->year,
            'description' => $request->description,
            'cover_image' => $coverPath,
            'slug'        => $slug,
        ]);

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album berhasil diperbarui');
    }

    public function destroy(Album $album)
    {
        if ($album->cover_image) {
            \Storage::disk('public')->delete($album->cover_image);
        }

        foreach ($album->items as $item) {
            \Storage::disk('public')->delete($item->file_path);
        }

        $album->delete();

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album berhasil dihapus');
    }

    /**
     * Generate slug unik. Jika slug sudah ada, tambahkan suffix -1, -2, dst.
     * Parameter $ignoreId digunakan saat update agar slug milik album sendiri tidak dianggap bentrok.
     */
    private function generateUniqueSlug(string $name, int $year, ?int $ignoreId = null): string
    {
        $base    = Str::slug($name . '-' . $year);
        $slug    = $base;
        $counter = 1;

        while (
            Album::where('slug', $slug)
                 ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                 ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}