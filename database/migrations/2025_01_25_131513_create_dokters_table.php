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
        Schema::create('dokters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('layanan_id');
            $table->string('kode_dokter');
            $table->string('nama_dokter');
            $table->string('sip');
            $table->json('hari_praktek');
            $table->json('jam_praktek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
