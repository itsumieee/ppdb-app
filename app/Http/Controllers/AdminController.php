<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRegistrations = Registration::count();
        $pending = Registration::where('status', 'pending')->count();
        $approved = Registration::where('status', 'approved')->count();
        $rejected = Registration::where('status', 'rejected')->count();

        $recentRegistrations = Registration::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalRegistrations', 'pending', 'approved', 'rejected', 'recentRegistrations'));
    }

    public function registrations()
    {
        $registrations = Registration::with('user')->latest()->paginate(15);
        return view('admin.registrations', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registration-detail', compact('registration'));
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

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('admin.registrations')->with('success', 'Data pendaftaran dihapus.');
    }

    public function exportCsv()
    {
        $registrations = Registration::with('user')->get();
        $filename = 'ppdb_data_' . date('Y-m-d') . '.csv';

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['No Pendaftaran', 'Nama Lengkap', 'NIK', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat', 'Asal Sekolah', 'Jurusan', 'Status', 'Catatan Admin', 'Tanggal Daftar']);

        foreach ($registrations as $reg) {
            fputcsv($handle, [
                $reg->registration_number,
                $reg->full_name,
                $reg->nik,
                $reg->place_of_birth,
                $reg->date_of_birth,
                $reg->address,
                $reg->previous_school,
                $reg->major_choice,
                $reg->status,
                $reg->admin_note,
                $reg->created_at
            ]);
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream(function () use ($handle) {
            fclose($handle);
        }, 200, $headers);
    }
}