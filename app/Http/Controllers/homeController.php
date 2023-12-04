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
        $periode = 'janjun';
        $tahun = 2024;

        // ...

        // Menggunakan Eloquent untuk mendapatkan data karyawan dengan nilai akhir
        $karyawan = Karyawan::with(['hasilPenilaian' => function ($query) use ($periode, $tahun) {
            $query->where('periode', $periode)->where('tahun', $tahun);
        }])
            ->get();

        // Memberikan nilai akhir pada setiap karyawan
        $karyawan->each(function ($data) use ($periode, $tahun) {
            $data->nilai_akhir = $data->hasilPenilaian->isEmpty() ? 0 : $data->hasilPenilaian->max('nilai_akhir');
        });

        // Mengurutkan karyawan berdasarkan nilai akhir secara descending
        $karyawan = $karyawan->sortByDesc('nilai_akhir');

        // Memberikan peringkat berdasarkan nilai akhir
        $ranking = 1;
        foreach ($karyawan as $data) {
            $data->peringkat = $ranking;
            $ranking++;
        }

        // ...


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
            dump($karyawan);



            return view('home', compact('karyawan', 'periode', 'tahun'));
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
