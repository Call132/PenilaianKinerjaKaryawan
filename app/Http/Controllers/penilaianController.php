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
        $karyawan = Karyawan::paginate(10);

        return view('penilaian', compact('karyawan', 'department'));
    }

    public function filter(Request $request)
    {
        $department = $request->input('department');

        if ($department === 'semua') {
            $karyawan = Karyawan::paginate(10);
        } else {
            $karyawan = Karyawan::where('department', $department)->paginate(10);
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

        try {
            $request->validate([
                'tanggal_penilaian' => 'required|date',
                'tujuan' => 'required|string',
                'tahun' => 'required',
                'periode' => 'required',
                'karyawan_id' => 'required',
                'posisi' => 'required|string',
                'skor' => 'nullable|array',
                'komentar' => 'nullable|array',
            ]);

            $karyawan = Karyawan::find($request->karyawan_id);
            $check = Penilaian::where('karyawan_id', $request->karyawan_id)->where('tahun', $request->tahun)->where('periode', $request->periode)->first();

            if ($check) {
                return redirect()->back()->withInput()->with('error', 'Karyawan Sudah Dinilai di periode ini');
            }

            $penilaian = new Penilaian();
            $penilaian->karyawan_id = $request->karyawan_id;
            $penilaian->tujuan = $request->tujuan;
            $penilaian->tanggal_penilaian = $request->tanggal_penilaian;
            $penilaian->tahun = $request->tahun;
            $penilaian->periode = $request->periode;
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
    public function edit($id)
    {
        try {
            $karyawan = Karyawan::find($id);
            if (!$karyawan) {
                return redirect()->back()->withInput()->with('error', 'Karyawan Tidak Ditemukan');
            }

            $penilaian = Penilaian::where('karyawan_id', $karyawan->id)->first();
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

            $skor = [];
            $komentar = [];
            foreach ($kriteriaNames as $kriteriaName) {
                $kriteria = Kriteria::where('kriteria', $kriteriaName)->first();

                if (!$kriteria) {
                    return response()->json(['message' => 'Kriteria tidak ditemukan: ' . $kriteriaName], 404);
                }

                $hasilPenilaian = $penilaian->hasilPenilaian()
                    ->where('penilaian_id', $penilaian->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('karyawan_id', $karyawan->id)
                    ->first();

                $skor[$kriteriaName] = $hasilPenilaian ? $hasilPenilaian->skor : null;
                $komentar[$kriteriaName] = $hasilPenilaian ? $hasilPenilaian->komentar : null;
            }



            return view('penilaian-edit', compact('penilaian', 'karyawan', 'kriteriaNames', 'skor', 'komentar'));
        } catch (\Exception $e) {
            return dd($e);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'skor' => 'nullable|array',
                'komentar' => 'nullable|array',
            ]);

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

            $penilaian = Penilaian::findOrFail($id);

            foreach ($kriteriaNames as $kriteriaName) {
                $kriteriaId = Kriteria::where('kriteria', $kriteriaName)->value('id');


                $hasilPenilaian = HasilPenilaian::where('penilaian_id', $penilaian->id)
                    ->where('kriteria_id', $kriteriaId)
                    ->first();

                if ($hasilPenilaian) {
                    $hasilPenilaian->update([
                        'skor' => $request->input('nilai_' . $kriteriaName),
                        'komentar' => $request->input('komentar_' . $kriteriaName),
                    ]);
                }
            }

            return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
