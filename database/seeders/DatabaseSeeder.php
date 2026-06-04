<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ParkingRate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Buat Akun Contoh
        User::create([
            'name' => 'Bapak Owner',
            'email' => 'owner@parkindo.com',
            'password' => Hash::make('password'),
            'role' => 'owner'
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@parkindo.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Ahmad Petugas',
            'email' => 'petugas@parkindo.com',
            'password' => Hash::make('password'),
            'role' => 'petugas'
        ]);

        // Data Tarif & Area Awal
        ParkingRate::create([
            'jenis_kendaraan' => 'Mobil',
            'tarif_flat' => 5000,
            'tarif_progresif' => 3000,
            'denda_hilang' => 50000,
            'area_parkir' => 'ZONA A - Lantai 1',
            'kapasitas_maksimal' => 50,
            'sisa_slot' => 50
        ]);

        ParkingRate::create([
            'jenis_kendaraan' => 'Motor',
            'tarif_flat' => 2000,
            'tarif_progresif' => 1000,
            'denda_hilang' => 20000,
            'area_parkir' => 'ZONA B - Halaman',
            'kapasitas_maksimal' => 100,
            'sisa_slot' => 100
        ]);
    }
}