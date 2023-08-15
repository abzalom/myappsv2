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
        Schema::create('rancangan5_subkegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd');
            $table->string('kode_urusan');
            $table->string('kode_bidang');
            $table->string('kode_program');
            $table->string('kode_kegiatan');
            $table->string('kode_subkegiatan');
            $table->text('uraian');
            $table->text('kinerja')->nullable();
            $table->float('target_kinerja', 8, 2)->nullable();
            $table->string('satuan_kinerja')->nullable();
            $table->text('indikator')->nullable();
            $table->float('target_indikator', 8, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->date('mulai')->nullable();
            $table->date('selesai')->nullable();
            $table->string('klasifikasi_belanja')->nullable();
            $table->enum('jenis', ['fisik', 'non fisik'])->nullable();
            $table->year('tahun');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rancangan5_subkegiatans');
    }
};
