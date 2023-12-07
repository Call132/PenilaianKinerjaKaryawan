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
        $karyawan = Karyawan::all();
        $departments = Karyawan::pluck('department')->unique();

        // Menghitung jumlah departemen
        $totalDepartments = $departments->count();



        $dipertahankan = Karyawan::where('rekomendasi', 'Dipertahankan')->count();

        $tidakDipertahankan = Karyawan::where('rekomendasi', 'Tidak Dipertahankan')->count();







        return view('home', compact('karyawan', 'totalDepartments', 'dipertahankan', 'tidakDipertahankan'));
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



            return view('home', compact('karyawan', 'periode', 'tahun'));
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
