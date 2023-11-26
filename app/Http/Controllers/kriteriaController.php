<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use Illuminate\Http\Request;

class kriteriaController extends Controller
{
    public function index()
    {
        $kriteria  = kriteria::all();
        return view('kriteria', compact('kriteria'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'bobot' => 'required|numeric|min:0.01',
        ]);

        // Buat kriteria baru
        $kriteria = new Kriteria();
        $kriteria->kriteria = str_replace(' ', '_', $request->input('nama'));
        $kriteria->bobot = $request->input('bobot');
        $kriteria->save();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0.01',
        ]);

        $kriteria = Kriteria::find($id);
        $kriteria->update([
            'kriteria' => $request->nama,
            'bobot' => $request->bobot,

        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);

        if (!$kriteria) {
            return redirect()->back()->with('error', 'Kriteria not found');
        }

        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria deleted successfully');
    }
}
