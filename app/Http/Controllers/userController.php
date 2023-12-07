<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    public function index()
    {
        $user = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->orderBy('name')->get();



        return view('user', compact('user'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'role' => 'required',
            ]);
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->with('error', 'Email sudah terdaftar!');
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);
            return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            return dd($e);
        }
    }
    public function update(Request $request, $id)
    {

        try {

            $request->validate([
                'name' => 'required',
                'email' => 'nullable|email',
                'role' => 'required',
            ]);

            $user = User::findOrFail($id);


            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user->syncRoles([$request->role]);

            return redirect()->route('user')->with('success', 'User berhasil diupdate');
        } catch (\Exception $e) {
            return dd($e);
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user')->with('success', 'User berhasil dihapus');
    }
}
