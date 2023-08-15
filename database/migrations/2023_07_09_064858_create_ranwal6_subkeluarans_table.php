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
        Schema::create('ranwal6_subkeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd');
            $table->string('kode_urusan');
            $table->string('kode_bidang');
            $table->string('kode_program');
            $table->string('kode_kegiatan');
            $table->string('kode_subkegiatan');
            $table->string('kode_subkeluaran');
            $table->text('uraian')->nullable();
            $table->float('target', 8, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('anggaran', 18, 2)->nullable();
            $table->decimal('ralisasi', 18, 2)->nullable();
            $table->decimal('anggaran_maju', 18, 2)->nullable();
            $table->string('sumberdana')->nullable();
            $table->text('lokasi')->nullable();
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
        Schema::dropIfExists('ranwal6_subkeluarans');
    }
};
