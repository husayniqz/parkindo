<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingTransaction extends Model {
    use HasFactory;
    protected $fillable = ['nomor_tiket', 'plat_nomor', 'parking_rate_id', 'waktu_masuk', 'waktu_keluar', 'total_biaya', 'metode_pembayaran', 'status', 'petugas_id'];

    public function rate() {
        return $this->belongsTo(ParkingRate::class, 'parking_rate_id');
    }

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}