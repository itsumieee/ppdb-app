<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::where('verification_status', '!=', 'verified');
        if ($request->status) {
            $query->where('verification_status', $request->status);
        }
        $registrations = $query->latest()->paginate(15);
        return view('admin.verification.index', compact('registrations'));
    }
    
    public function show(Registration $registration)
    {
        return view('admin.verification.show', compact('registration'));
    }
    
    public function verify(Registration $registration)
    {
        $registration->update([
            'verification_status' => 'verified',
            'verification_note' => null
        ]);
        return redirect()->back()->with('success', 'Berkas diverifikasi.');
    }
    
    public function reject(Request $request, Registration $registration)
    {
        $request->validate(['note' => 'required|string']);
        $registration->update([
            'verification_status' => 'rejected',
            'verification_note' => $request->note
        ]);
        return redirect()->back()->with('success', 'Berkas ditolak dengan catatan.');
    }
    
    public function download(Registration $registration, $fileType)
    {
        $field = $fileType . '_file';
        if ($registration->$field && Storage::exists($registration->$field)) {
            return Storage::download($registration->$field);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}