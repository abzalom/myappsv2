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
        Schema::create('a5_subkegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_urusan');
            $table->string('kode_bidang');
            $table->string('kode_program');
            $table->string('kode_kegiatan');
            $table->string('kode_subkegiatan')->unique();
            $table->text('uraian');
            $table->text('kinerja')->nullable();
            $table->text('indikator')->nullable();
            $table->string('satuan');
            $table->string('klasifikasi_belanja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a5_subkegiatans');
    }
};
