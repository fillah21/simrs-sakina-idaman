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
        Schema::create('jaminans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_jaminan');
            $table->string('nama_jaminan');
            $table->boolean('wajib_rujukan');
            $table->boolean('wajib_keterangan_jaminan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaminans');
    }
};
