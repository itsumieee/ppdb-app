<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with('user', 'major');
        
        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%'.$request->search.'%')
                  ->orWhere('registration_number', 'like', '%'.$request->search.'%')
                  ->orWhere('nik', 'like', '%'.$request->search.'%');
            });
        }
        
        // Filter jurusan
        if ($request->major) {
            $query->where('major_choice', $request->major);
        }
        
        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $registrations = $query->latest()->paginate(15);
        $majors = Major::all();
        
        return view('admin.registrations.index', compact('registrations', 'majors'));
    }
    
    public function show(Registration $registration)
    {
        $registration->load('user', 'major');
        return view('admin.registrations.show', compact('registration'));
    }
    
    public function edit(Registration $registration)
    {
        $majors = Major::all();
        return view('admin.registrations.edit', compact('registration', 'majors'));
    }
    
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:registrations,nik,'.$registration->id,
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'previous_school' => 'required|string',
            'major_choice' => 'required|exists:majors,code',
        ]);
        
        $registration->update($request->only(['full_name', 'nik', 'place_of_birth', 'date_of_birth', 'address', 'previous_school', 'major_choice']));
        
        return redirect()->route('admin.pendaftar.show', $registration)->with('success', 'Data pendaftar berhasil diupdate.');
    }
    
    public function destroy(Registration $registration)
    {
        // Hapus file jika ada
        foreach(['ijazah_file', 'rapor_file', 'kk_file', 'photo_file'] as $file) {
            if ($registration->$file) {
                Storage::delete($registration->$file);
            }
        }
        $registration->delete();
        return redirect()->route('admin.pendaftar.index')->with('success', 'Data pendaftar dihapus.');
    }
    
    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_note' => 'nullable|string'
        ]);
        
        $registration->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note
        ]);
        
        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
    
    public function printForm(Registration $registration)
    {
        // return view('admin.registrations.print', compact('registration'));
        // Untuk cetak, kita buat view khusus
        return view('admin.registrations.print', compact('registration'));
    }
}