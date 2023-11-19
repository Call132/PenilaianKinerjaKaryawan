<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class karyawanController extends Controller
{
    public function create()
    {
        return view('karyawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
        ]);

        try {
            $karyawan = new Karyawan;
            $karyawan->name = $request->name;
            $karyawan->department = $request->department;
            $karyawan->posisi = $request->posisi;
            $karyawan->tanggal_lahir = $request->tanggal_lahir;
            $karyawan->no_hp = $request->no_hp;
            $karyawan->joining_date = $request->joining_date;
            $karyawan->status = $request->status;
            $karyawan->save();

            return redirect()->route('karyawan.create')->with('success', 'Karyawan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(
                'error',
                'Karyawan gagal ditambahkan. Mohon periksa kembali data.'

            );
        }
    }

    public function index()
    {
        $karyawan = Karyawan::paginate(10);
        return view('data-karyawan', compact('karyawan'));
    }

    public function edit($id)
    {
        // Retrieve the record from the database based on the given $id
        $data = Karyawan::find($id);

        // Check if the record exists
        if (!$data) {
            // Handle the case when the data does not exist (e.g., show an error message or redirect)
            return redirect()->back()->with('error', 'data not found.');
        }

        return view('karyawan-edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        try {
            // Retrieve the record from the database based on the given $id
            $data = Karyawan::find($id);

            $request->validate([
                'name' => 'required',
                'department' => 'required',
                'tanggal_lahir' => 'required',
                'no_hp' => 'required',
                'joining_date' => 'required',
                'status' => 'required',
            ]);

            $data->name = $request->name;
            $data->department = $request->department;
            $data->posisi = $request->posisi;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->no_hp = $request->no_hp;
            $data->joining_date = $request->joining_date;
            $data->status = $request->status;
            $data->save();

            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(
                'error',
                'Karyawan gagal diubah. Mohon periksa kembali data.'
            );
        }
    }
    public function delete($id)
    {
        // Retrieve the record from the database based on the given $id
        try {
            $data = Karyawan::find($id);

            $data->delete();
            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
        } catch (\Exception $e) {
            return dd($e);
            return redirect()->back()->withInput()->with(
                'error',
                'Karyawan gagal dihapus. Mohon periksa kembali data.'
            );
        }
    }
}
