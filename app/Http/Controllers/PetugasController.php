<?php

namespace App\Http\Controllers;

use App\Models\ParkingTransaction;
use App\Models\ParkingRate;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Ditambahkan untuk memperbaiki error str_random
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller {
    
    public function dashboard() {
        // Mengambil semua data area tarif (bukan cuma yang sisa_slot > 0 agar tetap tampil di pilihan view jika penuh)
        $rates = ParkingRate::all();
        $activeParkings = ParkingTransaction::with('rate')->where('status', 'Masuk')->get();
        return view('petugas.dashboard', compact('rates', 'activeParkings'));
    }

    public function parkirMasuk(Request $request) {
        $request->validate([
            'plat_nomor' => 'required', 
            'parking_rate_id' => 'required'
        ]);
        
        $rate = ParkingRate::findOrFail($request->parking_rate_id);
        
        // Validasi jika kapasitas slot parkir sudah habis
        if ($rate->sisa_slot <= 0) {
            return back()->with('error', 'Slot parkir untuk area ini sudah penuh!');
        }

        // Memperbaiki error str_random menggunakan Str::random()
        $nomorTiket = 'PKD-' . strtoupper(Str::random(4)) . '-' . now()->format('ymdHis');

        ParkingTransaction::create([
            'nomor_tiket' => $nomorTiket,
            'plat_nomor' => strtoupper($request->plat_nomor),
            'parking_rate_id' => $rate->id,
            'waktu_masuk' => now(),
            'status' => 'Masuk'
        ]);

        // Kurangi sisa slot parkir
        $rate->decrement('sisa_slot');

        return back()->with('success', 'Kendaraan Berhasil Masuk! Nomor Tiket: ' . $nomorTiket);
    }

    public function parkirKeluar(Request $request, $id) {
        $transaction = ParkingTransaction::findOrFail($id);
        $rate = $transaction->rate;

        $waktuMasuk = Carbon::parse($transaction->waktu_masuk);
        $waktuKeluar = now();
        
        // Kalkulator Tarif Progresif Otomatis Berdasarkan Durasi Jam
        $durasiJam = ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60);
        $totalBiaya = $rate->tarif_flat;
        
        if ($durasiJam > 1) {
            $totalBiaya += ($durasiJam - 1) * $rate->tarif_progresif;
        }

        // Cek jika ada request tombol tiket hilang dari operator kasir
        if ($request->has('tiket_hilang') || $request->tiket_hilang == '1') {
            $totalBiaya += $rate->denda_hilang;
            $transaction->status = 'Tiket Hilang';
        } else {
            $transaction->status = 'Keluar';
        }

        $transaction->update([
            'waktu_keluar' => $waktuKeluar,
            'total_biaya' => $totalBiaya,
            'metode_pembayaran' => $request->metode_pembayaran ?? 'Tunai',
            'petugas_id' => Auth::id()
        ]);

        // Kembalikan jumlah kapasitas slot parkir yang tersedia
        $rate->increment('sisa_slot');

        return back()->with('success', 'Transaksi selesai. Total Bayar: Rp ' . number_format($totalBiaya, 0, ',', '.'));
    }
}