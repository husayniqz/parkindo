<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('parking_rates', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kendaraan'); // Mobil, Motor, Truk
            $table->integer('tarif_flat');
            $table->integer('tarif_progresif'); // Per jam berikutnya
            $table->integer('denda_hilang');
            $table->string('area_parkir');
            $table->integer('kapasitas_maksimal');
            $table->integer('sisa_slot');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('parking_rates');
    }
};