<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    // Menampilkan form edit profil sekolah
    public function edit()
    {
        $profil = [];
        $keys = ['nama_sekolah', 'alamat', 'kontak', 'email', 'whatsapp', 
                 'instagram', 'facebook', 'youtube', 'sejarah', 'visi_misi', 
                 'sambutan_kepsek', 'logo', 'favicon'];
        
        foreach ($keys as $key) {
            $profil[$key] = Pengaturan::where('key', $key)->value('value');
        }
        
        return view('admin.profil_sekolah.edit', compact('profil'));
    }

    // Update profil sekolah
    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:100',
            'facebook' => 'nullable|string|max:100',
            'youtube' => 'nullable|string|max:100',
            'sejarah' => 'nullable|string',
            'visi_misi' => 'nullable|string',
            'sambutan_kepsek' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024',
        ]);

        // Update atau buat data text
        $textFields = ['nama_sekolah', 'alamat', 'kontak', 'email', 'whatsapp', 
                       'instagram', 'facebook', 'youtube', 'sejarah', 'visi_misi', 'sambutan_kepsek'];
        
        foreach ($textFields as $field) {
            Pengaturan::updateOrCreate(
                ['key' => $field],
                ['value' => $request->$field]
            );
        }

        // Upload logo
        if ($request->hasFile('logo')) {
            $oldLogo = Pengaturan::where('key', 'logo')->value('value');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo')->store('profil', 'public');
            Pengaturan::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $path]
            );
        }

        // Upload favicon
        if ($request->hasFile('favicon')) {
            $oldFavicon = Pengaturan::where('key', 'favicon')->value('value');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $path = $request->file('favicon')->store('profil', 'public');
            Pengaturan::updateOrCreate(
                ['key' => 'favicon'],
                ['value' => $path]
            );
        }

        return redirect()->route('admin.profil_sekolah.edit')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}