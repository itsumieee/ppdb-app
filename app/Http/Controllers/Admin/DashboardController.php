<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = Registration::count();
        $totalDiterima = Registration::where('status', 'approved')->count();
        $totalDitolak = Registration::where('status', 'rejected')->count();
        $totalJurusan = Jurusan::count();

        // Data per bulan (total, diterima, ditolak)
        $currentYear = date('Y');
        $months = [];
        $counts = [];
        $approvedCounts = [];
        $rejectedCounts = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('M', mktime(0,0,0,$i,1));
            $counts[] = Registration::whereYear('created_at', $currentYear)->whereMonth('created_at', $i)->count();
            $approvedCounts[] = Registration::where('status', 'approved')->whereYear('created_at', $currentYear)->whereMonth('created_at', $i)->count();
            $rejectedCounts[] = Registration::where('status', 'rejected')->whereYear('created_at', $currentYear)->whereMonth('created_at', $i)->count();
        }

        $pendaftarTerbaru = Registration::latest()->take(5)->get();
        $jurusanStats = Jurusan::withCount('registrations')->get();

        return view('admin.dashboard', compact(
            'totalPendaftar', 'totalDiterima', 'totalDitolak', 'totalJurusan',
            'months', 'counts', 'approvedCounts', 'rejectedCounts',
            'pendaftarTerbaru', 'jurusanStats'
        ));
    }
}