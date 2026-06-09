<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $profile = SchoolProfile::first();
        return view('admin.profile.index', compact('profile'));
    }
    
    public function update(Request $request)
    {
        $profile = SchoolProfile::first();
        $data = $request->validate([
            'history' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'principal_speech' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);
        
        if ($profile) {
            $profile->update($data);
        } else {
            SchoolProfile::create($data);
        }
        
        return redirect()->route('admin.profil_sekolah.edit')->with('success', 'Profil sekolah diperbarui.');
    }
}