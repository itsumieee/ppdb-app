<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan dengan filter
    public function index(Request $request)
    {
        $query = Registration::with('user');
        
        // Filter jurusan
        if ($request->filled('jurusan')) {
            $query->where('major_choice', $request->jurusan);
        }
        
        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $pendaftar = $query->latest()->paginate(20);
        $jurusanList = Jurusan::all();
        
        // Statistik ringkasan
        $totalPendaftar = Registration::count();
        $totalDiterima = Registration::where('status', 'approved')->count();
        $totalDitolak = Registration::where('status', 'rejected')->count();
        $totalPending = Registration::where('status', 'pending')->count();
        
        // Statistik per jurusan
        $jurusanStats = Jurusan::withCount('registrations')->get();
        
        return view('admin.laporan.index', compact(
            'pendaftar', 'jurusanList', 'totalPendaftar', 'totalDiterima', 
            'totalDitolak', 'totalPending', 'jurusanStats', 'request'
        ));
    }
    
    // Export PDF
    public function exportPdf(Request $request)
    {
        $query = Registration::with('user');
        
        if ($request->filled('jurusan')) {
            $query->where('major_choice', $request->jurusan);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $pendaftar = $query->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('pendaftar', 'request'));
        return $pdf->download('laporan_ppdb_' . date('Y-m-d') . '.pdf');
    }
    
    // Export Excel
    public function exportExcel(Request $request)
    {
        $filters = [
            'jurusan' => $request->jurusan,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];
        
        return Excel::download(new RegistrationsExport($filters), 'laporan_ppdb_' . date('Y-m-d') . '.xlsx');
    }
    
    // Cetak laporan (view HTML khusus cetak)
    public function print(Request $request)
    {
        $query = Registration::with('user');
        
        if ($request->filled('jurusan')) {
            $query->where('major_choice', $request->jurusan);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $pendaftar = $query->get();
        return view('admin.laporan.print', compact('pendaftar', 'request'));
    }
}