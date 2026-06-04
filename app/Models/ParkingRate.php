<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingRate extends Model {
    use HasFactory;
    protected $fillable = ['jenis_kendaraan', 'tarif_flat', 'tarif_progresif', 'denda_hilang', 'area_parkir', 'kapasitas_maksimal', 'sisa_slot'];
}