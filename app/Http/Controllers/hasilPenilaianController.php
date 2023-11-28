<?php

namespace App\Http\Controllers;

use App\Models\hasilPenilaian;
use App\Models\Karyawan;
use App\Models\kriteria;
use App\Models\penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hasilPenilaianController extends Controller
{
    public function index()
    {
        try {
            $karyawan = Karyawan::paginate(10);

            foreach ($karyawan as $karyawanItem) {
                $hasilPenilaian = $karyawanItem->hasilPenilaian;

                if ($hasilPenilaian->isEmpty()) {
                    $karyawanItem->update(['rekomendasi' => 'Belum Dinilai']);
                    continue;
                }

                $nilaiAkhir = 0; // Reset nilaiAkhir for each karyawanItem
                $skorNormalisasi = 0;
                foreach ($hasilPenilaian as $penilaian) {
                    $bobot = Kriteria::find($penilaian->kriteria_id)->bobot;
                    $maxSkor = HasilPenilaian::where('kriteria_id', $penilaian->kriteria_id)->max('skor');
                    $skorNormalisasi = $penilaian->skor / $maxSkor;

                   


                    $penilaian->update(['skor_normalisasi' => $skorNormalisasi]);
                    $nilaiAkhir += $skorNormalisasi * $bobot;
                    
                    $penilaian->update(['nilai_akhir' => number_format($nilaiAkhir, 2)]);
                }
                $threshold = 0.4;

                
                $rekomendasi = $nilaiAkhir >= $threshold ? 'Dipertahankan' : 'Tidak Dipertahankan';
                $karyawanItem->update(['rekomendasi' => $rekomendasi]);

                $skorNormalisasi = 0;
                $nilaiAkhir = 0;
            }

            // Setelah selesai iterasi karyawan, tampilkan view
            return view('hasilPenilaian', compact('karyawan'));
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }
}
