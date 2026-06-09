<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $albums = Gallery::select('album')->distinct()->pluck('album');
        $query = Gallery::query();
        if ($request->album) {
            $query->where('album', $request->album);
        }
        $galleries = $query->latest()->paginate(20);
        return view('admin.galleries.index', compact('galleries', 'albums'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string',
            'album' => 'nullable|string'
        ]);
        
        $path = $request->file('image')->store('galleries', 'public');
        Gallery::create([
            'title' => $request->title,
            'image' => $path,
            'album' => $request->album
        ]);
        
        return redirect()->route('admin.galeri.index')->with('success', 'Foto ditambahkan.');
    }
    
    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->image);
        $gallery->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Foto dihapus.');
    }
    
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'nullable|string',
            'album' => 'nullable|string'
        ]);
        $gallery->update($request->only('title', 'album'));
        return redirect()->back()->with('success', 'Data foto diperbarui.');
    }
}