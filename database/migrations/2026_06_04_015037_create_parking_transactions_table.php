<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('parking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->string('plat_nomor');
            $table->foreignId('parking_rate_id')->constrained('parking_rates')->onDelete('cascade');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->integer('total_biaya')->default(0);
            $table->string('metode_pembayaran')->nullable();
            $table->string('status')->default('Masuk');
            
            // PERBAIKAN: Kembalikan menjadi 'users' (pakai 's' di belakang)
            $table->foreignId('petugas_id')->nullable()->constrained('user')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('parking_transactions');
    }
};