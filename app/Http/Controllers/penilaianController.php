<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class penilaianController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = Karyawan::all();
        $department = $request->input('department');
        $data = Karyawan::where('department', $department)->get();
    
        return view('penilaian', compact('karyawan', 'data'));
    }
    
    public function filter(Request $request)
    {
        $department = $request->input('department');
    
        $data = Karyawan::when($department, function ($query) use ($department) {
            return $query->where('department', $department);
        })->get();
 
    
        return view('penilaian', compact('data', 'department'));
    }
}
