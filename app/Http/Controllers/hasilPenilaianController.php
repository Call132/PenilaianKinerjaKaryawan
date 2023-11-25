<?php

namespace App\Http\Controllers;

use App\Models\hasilPenilaian;
use App\Models\Karyawan;
use App\Models\kriteria;
use App\Models\penilaian;
use Illuminate\Http\Request;

class hasilPenilaianController extends Controller
{
    public function index()
    {
        try {
            $karyawan = Karyawan::paginate(10);

            foreach ($karyawan as $karyawanItem) {
                $hasilPenilaian = $karyawanItem->hasilPenilaian;
                $nilaiAkhir = 0;
                if ($hasilPenilaian->isEmpty()) {
                    $karyawanItem->update(['rekomendasi' => 'Belum Dinilai']);
                    continue;
                }

                foreach ($hasilPenilaian as $penilaian) {
                    $bobot = Kriteria::find($penilaian->kriteria_id)->bobot;
                    $maxSkor = HasilPenilaian::where('kriteria_id', $penilaian->kriteria_id)->max('skor');
                    $skorNormalisasi = $penilaian->skor / $maxSkor;
                    $penilaian->update(['skor_normalisasi' => $skorNormalisasi]);

                    // Nilai akhir per kriteria harus diakumulasikan di dalam loop
                    $nilaiAkhir += $skorNormalisasi * $bobot;
                    $penilaian->update(['nilai_akhir' => number_format($nilaiAkhir, 2)]);
                }

                $threshold = [0.2, 0.4, 0.6, 0.8];

                // Perhitungan rekomendasi setelah selesai iterasi hasil penilaian
                $rekomendasi = $nilaiAkhir >= 0.8 ? 'Kinerja Sangat Baik' : ($nilaiAkhir >= 0.6 ? 'Kinerja Baik' : ($nilaiAkhir >= 0.4 ? 'Kinerja Cukup' : 'Kinerja Kurang'));
                $karyawanItem->rekomendasi = $rekomendasi;
            }

            // Setelah selesai iterasi karyawan, tampilkan view
            return view('hasilPenilaian', compact('karyawan'));
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }
}
