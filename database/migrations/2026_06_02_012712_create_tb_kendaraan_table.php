<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->string('plat_nomor', 255)->unique();
            $table->string('jenis_kendaraan', 255);
            $table->string('warna', 255);
            $table->string('pemilik', 255);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tb_kendaraan');
    }
};