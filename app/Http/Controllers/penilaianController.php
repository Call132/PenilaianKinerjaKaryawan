<?php

namespace App\Http\Controllers;

use App\Models\hasilPenilaian;
use App\Models\Karyawan;
use App\Models\kriteria;
use App\Models\KriteriaPenilaian;
use App\Models\penilaian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class penilaianController extends Controller
{
    public function index(Request $request)
    {
        $department = $request->input('department');
        $karyawan = Karyawan::all();

        return view('penilaian', compact('karyawan', 'department'));
    }

    public function filter(Request $request)
    {
        $department = $request->input('department');

        if ($department === 'semua') {
            $karyawan = Karyawan::all();
        } else {
            $karyawan = Karyawan::where('department', $department)->get();
        }

        return view('penilaian', compact('karyawan', 'department'));
    }

    public function form($id)
    {
        $karyawan = Karyawan::find($id);
        return view('form-penilaian', compact('karyawan'));
    }

    public function store(Request $request)
    {
        dd($request->all());

        try {
            $request->validate([
                'tanggal_penilaian' => 'required|date',
                'tujuan' => 'required|string',
                'periode_penilaian' => 'required',
                'karyawan_id' => 'required',
                'posisi' => 'required|string',
                'skor' => 'nullable|array',
                'komentar' => 'nullable|array',
            ]);

            $karyawan = Karyawan::find($request->karyawan_id);

            if ($karyawan->penilaian_status == 1) {
                return redirect()->back()->withInput()->with('error', 'Karyawan Sudah Dinilai di periode ini');
            }

            $penilaian = new Penilaian();
            $penilaian->karyawan_id = $request->karyawan_id;
            $penilaian->tujuan = $request->tujuan;
            $penilaian->periode_penilaian = $request->periode_penilaian;
            $penilaian->tanggal_penilaian = $request->tanggal_penilaian;
            $karyawan->penilaian_status = 1;

            $kriteriaNames = [
                'service_spirit',
                'customer_focus',
                'sales_ability',
                'initiative',
                'adaptation',
                'decision_making',
                'change_management',
                'communication',
                'team_coordination',
                'leadership',
                'people_development',
                'commercial_awareness',
                'problem_solving',
                'integrity',
                'corporate_sense',
                'analyze_perspective',
                'time_management',
            ];
            $karyawan->save();
            $penilaian->save();


            foreach ($kriteriaNames as $kriteriaName) {
                $kriteria = Kriteria::where('kriteria', $kriteriaName)->first();

                $hasilPenilaian = new hasilPenilaian([
                    'penilaian_id' => $penilaian->id,
                    'kriteria_id' => $kriteria->id,
                    'karyawan_id' => $karyawan->id,
                    'skor' => $request->input('nilai_' . $kriteriaName),
                    'komentar' => $request->input('komentar_' . $kriteriaName),
                ]);

                $hasilPenilaian->save();
            }

            return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan');
        } catch (\Exception $e) {

            return dd($e);
        }
    }
}
