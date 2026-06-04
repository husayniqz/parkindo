<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ParkingRate;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function dashboard() {
        $totalPengguna = User::count();
        $totalArea = ParkingRate::count();
        $users = User::all();
        $rates = ParkingRate::all();
        $logs = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalPengguna', 'totalArea', 'users', 'rates', 'logs'));
    }

    // CRUD USER
    public function storeUser(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        ActivityLog::create(['user_id' => Auth::id(), 'aktivitas' => 'Menambahkan user baru: ' . $request->name]);
        return back()->with('success', 'User berhasil ditambahkan');
    }

    // UPDATE TARIF / KAPASITAS
    public function updateRate(Request $request, $id) {
        $rate = ParkingRate::findOrFail($id);
        $rate->update($request->only(['tarif_flat', 'tarif_progresif', 'denda_hilang', 'kapasitas_maksimal']));

        ActivityLog::create(['user_id' => Auth::id(), 'aktivitas' => 'Mengubah konfigurasi tarif kategori: ' . $rate->jenis_kendaraan]);
        return back()->with('success', 'Tarif updated successfully');
    }
}