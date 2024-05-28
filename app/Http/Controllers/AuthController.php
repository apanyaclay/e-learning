<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_form(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $email     = $request->email;
            $password  = $request->password;
            if (Auth::attempt(['email'=>$email,'password'=>$password])) {
                $request->session()->regenerate();
                $user = Auth::user();
                if ($user->role == 'admin') {
                    Toastr::success('Berhasil masuk :)','Success');
                    return redirect()->intended('admin/dashboard');
                } elseif ($user->role == 'guru') {
                    Toastr::success('Berhasil masuk :)','Success');
                    return redirect()->intended('guru/dashboard');
                } else {
                    Toastr::success('Berhasil masuk :)','Success');
                    return redirect()->intended('siswa/dashboard');
                }
            } else {
                Toastr::error('Gagal, USERNAME ATAU PASSWORD SALAH :)','Error');
                return redirect()->route('login');
            }
        } catch (\Exception $e){
            DB::rollBack();
            Toastr::error('Gagal masuk :)','Error');
            return redirect()->back();
        };
    }

    public function register()
    {
        return view('auth.register');
    }
    public function register_form(Request $request)
    {
        $request->validate([
            'username'       => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users',
            'role_name'      => 'required|string|max:255',
            'password'       => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'role'      => $request->role_name,
            'password'  => Hash::make($request->password),
        ]);

        Toastr::success('Berhasil membuat akun baru :)','Success');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        Toastr::success('Berhasil keluar :)','Success');
        return redirect()->route('login');
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            Toastr::success('Berhasil mengubah kata sandi :)','Success');
            return redirect()->route('home');
        } else {
            Toastr::error('Kata Sandi lama salah','Error');
            return redirect()->back();
        }
    }
}
