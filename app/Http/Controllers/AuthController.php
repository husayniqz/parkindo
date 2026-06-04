<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktifitas;
use Carbon\Carbon;

class AuthController extends Controller {
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Catat Log Aktifitas
            LogAktifitas::create([
                'id_user' => $user->id_user,
                'aktivitas' => 'Melakukan Login ke Sistem',
                'waktu_aktivitas' => Carbon::now()
            ]);

            // Pengalihan halaman berdasarkan role
            return match ($user->role) {
        'admin'   => redirect()->intended(route('admin.dashboard')),
        'petugas' => redirect()->intended(route('petugas.dashboard')),
        'owner'   => redirect()->intended(route('owner.dashboard')),
        default   => redirect('/'),
        };
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request) {
        if(Auth::check()){
            LogAktifitas::create([
                'id_user' => Auth::id(),
                'aktivitas' => 'Melakukan Logout',
                'waktu_aktivitas' => Carbon::now()
            ]);
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}