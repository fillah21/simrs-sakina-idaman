<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pasien_id');
            $table->string('no_pendaftaran');
            $table->dateTime('waktu_kunjungan');
            $table->string('antrian');
            $table->uuid('instalasi_id');
            $table->uuid('layanan_id');
            $table->uuid('dokter_id');
            $table->uuid('jaminan_id');
            $table->string('no_jaminan')->nullable();
            $table->string('nama_penjamin')->nullable();
            $table->string('cara_masuk');
            $table->string('rujukan')->nullable();
            $table->text('keluhan');
            $table->uuid('tindakan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
