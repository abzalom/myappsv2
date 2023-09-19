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
        Schema::create('perubahan6_subkeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd');
            $table->string('kode_urusan');
            $table->string('kode_bidang');
            $table->string('kode_program');
            $table->string('kode_kegiatan');
            $table->string('kode_subkegiatan');
            $table->string('kode_subkeluaran');
            $table->text('uraian')->nullable();
            // Semula
            $table->float('target', 8, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('anggaran', 18, 2)->nullable();
            $table->decimal('anggaran_maju', 18, 2)->nullable();
            $table->string('sumberdana')->nullable();
            $table->text('lokasi')->nullable();
            // Menjadi
            $table->float('menjadi_target', 8, 2)->nullable();
            $table->string('menjadi_satuan')->nullable();
            $table->decimal('menjadi_anggaran', 18, 2)->nullable();
            $table->decimal('menjadi_anggaran_maju', 18, 2)->nullable();
            $table->string('menjadi_sumberdana')->nullable();
            $table->text('menjadi_lokasi')->nullable();

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
        Schema::dropIfExists('perubahan6_subkeluarans');
    }
};
