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
        Schema::create('pendapatan7_uraian_perubahans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_rincian');
            $table->string('kode_subrincian');
            $table->string('kode_uraian');
            $table->text('uraian');
            // semula
            $table->decimal('jumlah', 18, 2);
            // menjadi
            $table->decimal('menjadi_jumlah', 18, 2);
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
        Schema::dropIfExists('pendapatan7_uraian_perubahans');
    }
};
