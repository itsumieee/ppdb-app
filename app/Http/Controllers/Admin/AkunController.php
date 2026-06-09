<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AkunController extends Controller
{
    // Menampilkan form edit profil admin
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.akun.index', compact('admin'));
    }

    // Update profil admin (nama, email)
    public function update(Request $request)
    {
        $admin = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    // Update password admin
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $admin = Auth::user();
        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Password berhasil diubah.');
    }
}