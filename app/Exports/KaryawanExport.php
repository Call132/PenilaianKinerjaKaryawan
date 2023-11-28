<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KaryawanExport implements FromCollection, WithEvents, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Karyawan::orderBy('department')->get()->map(function ($item) {
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['rekomendasi']);
            unset($item['penilaian_status']);
            return $item;
        });
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1:H2')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:H1')->getAlignment()->setVertical('center');

        $sheet->getStyle('A1:H2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(13);
        $sheet->getColumnDimension('D')->setWidth(26);
        $sheet->getColumnDimension('E')->setWidth(12);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(12);
        $sheet->getColumnDimension('H')->setWidth(18);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $sheet->setCellValue('A1', 'Daftar Karyawan Yulia Hotel');

                // Set baris pertama untuk header
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Department');
                $sheet->setCellValue('C2', 'Posisi');
                $sheet->setCellValue('D2', 'Name');
                $sheet->setCellValue('E2', 'Tanggal Lahir');
                $sheet->setCellValue('F2', 'No HP');
                $sheet->setCellValue('G2', 'Joining Date');
                $sheet->setCellValue('H2', 'Status');

                // Mulai dari baris ketiga untuk data karyawan
                $row = 3;
                $no = 1;

                // Ambil data karyawan berdasarkan departemen dan urutkan berdasarkan departemen
                $employees = Karyawan::orderBy('department')->get();

                // Set nilai untuk setiap baris data karyawan
                foreach ($employees as $employee) {
                    $sheet->setCellValue('A' . $row, $no);
                    $sheet->setCellValue('B' . $row, $employee->department);
                    $sheet->setCellValue('C' . $row, $employee->posisi);
                    $sheet->setCellValue('D' . $row, $employee->name);
                    $sheet->setCellValue('E' . $row, $employee->tanggal_lahir);
                    $sheet->setCellValue('F' . $row, $employee->no_hp);
                    $sheet->setCellValue('G' . $row, $employee->joining_date);
                    $sheet->setCellValue('H' . $row, $employee->status);

                    // Increment index baris
                    $sheet->getStyle('A3:H' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $row++;
                    $no++;
                }
            }
        ];
    }
}
