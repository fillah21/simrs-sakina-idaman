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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pasien');
            $table->string('no_rm');
            $table->string('nik');
            $table->enum('jk', ['L', 'P']);
            $table->text('alamat');
            $table->enum('status_nikah', ['Belum Menikah', 'Menikah', 'Janda/Duda']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->bigInteger('provinsi_id');
            $table->bigInteger('kabupaten_id');
            $table->bigInteger('kecamatan_id');
            $table->bigInteger('kelurahan_id');
            $table->uuid('agama_id');
            $table->uuid('pekerjaan_id');
            $table->uuid('pendidikan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
