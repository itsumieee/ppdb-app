<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profile.index', compact('admin'));
    }
    
    public function update(Request $request)
    {
        $admin = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$admin->id,
        ]);
        
        $admin->update($request->only('name', 'email'));
        return redirect()->route('admin.akun.index')->with('success', 'Profil diupdate.');
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        
        $admin = Auth::user();
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }
        
        $admin->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('admin.akun.index')->with('success', 'Password diubah.');
    }
}