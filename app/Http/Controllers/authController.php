<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class authController extends Controller
{
    use RegistersUsers;
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'name'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, redirect ke halaman yang sesuai
            return redirect()->intended('/');
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/login');
    }



    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Setelah validasi berhasil, Anda dapat melakukan logika penyimpanan data pengguna di sini
        // Misalnya, Anda dapat menyimpan data pengguna ke dalam tabel pengguna

        if ($this->create($request->all())) {
            // Jika registrasi berhasil, alihkan pengguna ke halaman yang sesuai
            return redirect($this->redirectPath());
        }

        // Jika registrasi gagal, simpan pesan error ke dalam session
        session()->flash('error', 'Registrasi gagal. Mohon periksa kembali data Anda.');
        return redirect()->back();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
