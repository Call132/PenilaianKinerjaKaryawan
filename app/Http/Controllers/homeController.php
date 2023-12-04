<?php

namespace App\Http\Controllers;

use App\Models\hasilPenilaian;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->input('periode', date('n') <= 6 ? 'janjun' : 'juldec');
        $tahun = $request->input('tahun', date('Y'));

        $karyawan = Karyawan::all(); // Ganti 10 dengan jumlah item per halaman yang diinginkan


        // Menambahkan peringkat pada setiap karyawan
        $peringkat = 1;
        foreach ($karyawan as $data) {
            $data->nilai_akhir = $data->hasilPenilaian->last()->nilai_akhir ?? 0;
        }

        // Mengurutkan array karyawan berdasarkan nilai akhir secara descending
        $karyawan = $karyawan->sortByDesc('nilai_akhir');



        // Menambahkan peringkat pada setiap karyawan
        foreach ($karyawan as $data) {
            $data->peringkat = $peringkat;
            $peringkat++;
        }

        return view('home', compact('karyawan', 'periode', 'tahun'));
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
                $hasilPenilaian = hasilPenilaian::where('karyawan_id', $karyawanItem->id)
                    ->where('periode', $periode)
                    ->where('tahun', $tahun)
                    ->get();
            }
            $query = Karyawan::query();

            $karyawan = $query->with(['penilaian' => function ($query) use ($periode, $tahun) {
                $query->where('periode', $periode)->whereYear('tanggal_penilaian', $tahun);
            }])->paginate(10);

            $peringkat = 1;
            foreach ($karyawan as $data) {
                $data->nilai_akhir = $data->hasilPenilaian->last()->nilai_akhir ?? 0;
            }

            // Mengurutkan array karyawan berdasarkan nilai akhir secara descending
            $karyawan = $karyawan->sortByDesc('nilai_akhir');

            // Menambahkan peringkat pada setiap karyawan
            foreach ($karyawan as $data) {
                $data->peringkat = $peringkat;
                $peringkat++;
            }


            return view('home', compact('karyawan', 'periode', 'tahun'));
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
