<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Menampilkan daftar galeri
    public function index(Request $request)
    {
        $query = Galeri::query();
        
        if ($request->filled('album')) {
            $query->where('album', $request->album);
        }
        
        $galeri = $query->latest()->paginate(12);
        $albums = Galeri::select('album')->distinct()->whereNotNull('album')->pluck('album');
        
        return view('admin.galeri.index', compact('galeri', 'albums'));
    }

    // Form tambah galeri
    public function create()
    {
        return view('admin.galeri.create');
    }

    // Simpan galeri baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:5120', // max 5MB
            'album' => 'nullable|string|max:100'
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'album' => $request->album
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    // Form edit galeri
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    // Update galeri
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'album' => 'nullable|string|max:100'
        ]);

        $data = ['judul' => $request->judul, 'album' => $request->album];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $path = $request->file('gambar')->store('galeri', 'public');
            $data['gambar'] = $path;
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    // Hapus galeri
    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}