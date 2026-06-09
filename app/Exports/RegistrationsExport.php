<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;
    
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }
    
    public function collection()
    {
        $query = Registration::query();
        
        if (!empty($this->filters['jurusan'])) {
            $query->where('major_choice', $this->filters['jurusan']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }
        
        return $query->get();
    }
    
    public function headings(): array
    {
        return [
            'No Pendaftaran', 'Nama Lengkap', 'NIK', 'Tempat Lahir', 'Tanggal Lahir',
            'Alamat', 'Asal Sekolah', 'Jurusan', 'Status', 'Tanggal Daftar'
        ];
    }
    
    public function map($registration): array
    {
        return [
            $registration->registration_number,
            $registration->full_name,
            $registration->nik,
            $registration->place_of_birth,
            $registration->date_of_birth,
            $registration->address,
            $registration->previous_school,
            $registration->major_choice,
            $registration->status,
            $registration->created_at->format('d/m/Y')
        ];
    }
}