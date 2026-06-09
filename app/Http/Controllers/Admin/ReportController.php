<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('admin.reports.index', compact('majors'));
    }
    
    public function exportPdf(Request $request)
    {
        $query = Registration::with('user', 'major');
        if ($request->status) $query->where('status', $request->status);
        if ($request->major) $query->where('major_choice', $request->major);
        $registrations = $query->get();
        
        $pdf = new Dompdf();
        $html = View::make('admin.reports.pdf', compact('registrations'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return $pdf->stream('laporan_ppdb.pdf');
    }
    
    public function exportExcel(Request $request)
    {
        $query = Registration::with('user', 'major');
        if ($request->status) $query->where('status', $request->status);
        if ($request->major) $query->where('major_choice', $request->major);
        $registrations = $query->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No Pendaftaran');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Jurusan');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'Tanggal Daftar');
        
        $row = 2;
        foreach ($registrations as $reg) {
            $sheet->setCellValue('A'.$row, $reg->registration_number);
            $sheet->setCellValue('B'.$row, $reg->full_name);
            $sheet->setCellValue('C'.$row, $reg->nik);
            $sheet->setCellValue('D'.$row, $reg->major_choice);
            $sheet->setCellValue('E'.$row, $reg->status);
            $sheet->setCellValue('F'.$row, $reg->created_at->format('d/m/Y'));
            $row++;
        }
        
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="laporan_ppdb.xlsx"');
        $writer->save('php://output');
    }
    
    public function print(Request $request)
    {
        $query = Registration::with('user', 'major');
        if ($request->status) $query->where('status', $request->status);
        if ($request->major) $query->where('major_choice', $request->major);
        $registrations = $query->get();
        return view('admin.reports.print', compact('registrations'));
    }
}