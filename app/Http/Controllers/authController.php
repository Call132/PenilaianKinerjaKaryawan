<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    use RegistersUsers;
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);
        $request->session()->regenerate();

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'You have successfully logged in!');
        }

        return redirect()->route('login')
            ->with('error', 'Username or password is incorrect.');
    }

    public function logout(Request $request)
    {

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    protected $redirectTo = '/';



    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

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
