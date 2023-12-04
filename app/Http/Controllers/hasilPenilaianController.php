<?php

namespace App\Http\Controllers;

use App\Models\hasilPenilaian;
use App\Models\Karyawan;
use App\Models\kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hasilPenilaianController extends Controller
{
    public function index(Request $request)
    {
        try {


            $periode = $request->input('periode', date('n') <= 6 ? 'janjun' : 'juldec');
            $tahun = $request->input('tahun', date('Y'));
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
                    if ($penilaian->penilaian->periode === $periode && $penilaian->penilaian->tahun == $tahun) {
                        $bobot = Kriteria::find($penilaian->kriteria_id)->bobot;
                        $maxSkor = HasilPenilaian::where('kriteria_id', $penilaian->kriteria_id)
                            ->whereHas('penilaian', function ($query) use ($periode, $tahun) {
                                $query->where('periode', $periode)->where('tahun', $tahun);
                            })
                            ->max('skor');
                        $minSkor = HasilPenilaian::where('kriteria_id', $penilaian->kriteria_id)
                            ->whereHas('penilaian', function ($query) use ($periode, $tahun) {
                                $query->where('periode', $periode)->where('tahun', $tahun);
                            })
                            ->min('skor');

                        $skorNormalisasi = $penilaian->skor / $maxSkor;

                        $penilaian->update(['skor_normalisasi' => $skorNormalisasi]);
                        $nilaiAkhir += $bobot * $skorNormalisasi;

                        $penilaian->update(['nilai_akhir' => number_format($nilaiAkhir, 2)]);
                    }
                }

                $threshold = 0.4;


                $rekomendasi = $nilaiAkhir >= $threshold ? 'Dipertahankan' : 'Tidak Dipertahankan';
                $karyawanItem->update(['rekomendasi' => $rekomendasi]);

                $skorNormalisasi = 0;
                $nilaiAkhir = 0;
            }

            // Setelah selesai iterasi karyawan, tampilkan view
            return view('hasilPenilaian', compact('karyawan', 'periode', 'tahun'));
        } catch (\Exception $e) {
            return dd($e);
        }
    }
    public function filter(Request $request)
    {
        try {
            $request->validate([
                'periode' => 'required',
                'tahun' => 'required',
            ]);
            $periode = $request->input('periode');
            $tahun = $request->input('tahun');

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
                    if ($penilaian->penilaian->periode === $periode && $penilaian->penilaian->tahun == $tahun) {
                        $bobot = Kriteria::find($penilaian->kriteria_id)->bobot;
                        $maxSkor = HasilPenilaian::where('kriteria_id', $penilaian->kriteria_id)
                            ->whereHas('penilaian', function ($query) use ($periode, $tahun) {
                                $query->where('periode', $periode)->where('tahun', $tahun);
                            })
                            ->max('skor');
                        $minSkor = HasilPenilaian::where('kriteria_id', $penilaian->kriteria_id)
                            ->whereHas('penilaian', function ($query) use ($periode, $tahun) {
                                $query->where('periode', $periode)->where('tahun', $tahun);
                            })
                            ->min('skor');

                        $skorNormalisasi = $penilaian->skor / $maxSkor;

                        $penilaian->update(['skor_normalisasi' => $skorNormalisasi]);
                        $nilaiAkhir += $bobot * $skorNormalisasi;

                        $penilaian->update(['nilai_akhir' => number_format($nilaiAkhir, 2)]);
                    }
                }

                $threshold = 0.4;


                $rekomendasi = $nilaiAkhir >= $threshold ? 'Dipertahankan' : 'Tidak Dipertahankan';
                $karyawanItem->update(['rekomendasi' => $rekomendasi]);

                $skorNormalisasi = 0;
                $nilaiAkhir = 0;
            }
            return view('hasilPenilaian', compact('karyawan', 'periode', 'tahun'));
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
