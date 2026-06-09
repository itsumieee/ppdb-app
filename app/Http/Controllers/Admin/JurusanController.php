<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    // Menampilkan daftar jurusan
    public function index()
    {
        $jurusan = Jurusan::withCount('registrations')->latest()->paginate(10);
        return view('admin.jurusan.index', compact('jurusan'));
    }

    // Form tambah jurusan
    public function create()
    {
        return view('admin.jurusan.create');
    }

    // Simpan jurusan baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('gambar');
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('jurusan', 'public');
            $data['gambar'] = $path;
        }

        Jurusan::create($data);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    // Form edit jurusan
    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    // Update jurusan
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode,' . $jurusan->id,
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('gambar');
        if ($request->hasFile('gambar')) {
            if ($jurusan->gambar) {
                Storage::disk('public')->delete($jurusan->gambar);
            }
            $path = $request->file('gambar')->store('jurusan', 'public');
            $data['gambar'] = $path;
        }

        $jurusan->update($data);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    // Hapus jurusan
    public function destroy(Jurusan $jurusan)
    {
        // Cek apakah jurusan sudah memiliki pendaftar
        if ($jurusan->registrations()->count() > 0) {
            return redirect()->route('admin.jurusan.index')
                ->with('error', 'Jurusan tidak bisa dihapus karena masih memiliki pendaftar.');
        }

        if ($jurusan->gambar) {
            Storage::disk('public')->delete($jurusan->gambar);
        }
        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }

    // Update kuota jurusan (opsional)
    public function updateKuota(Request $request, Jurusan $jurusan)
    {
        $request->validate(['kuota' => 'required|integer|min:1']);
        $jurusan->update(['kuota' => $request->kuota]);

        return redirect()->back()->with('success', 'Kuota berhasil diperbarui.');
    }

    // Menampilkan jumlah pendaftar per jurusan (bisa diakses via AJAX atau view terpisah)
    public function statistik()
    {
        $statistik = Jurusan::withCount('registrations')->get();
        return view('admin.jurusan.statistik', compact('statistik'));
    }
}