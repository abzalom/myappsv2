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
        Schema::create('b6_subrincian_neracas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_rincian');
            $table->string('kode_subrincian');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index();
            $table->string('kode_unik_objek')->index();
            $table->string('kode_unik_rincian')->index();
            $table->string('kode_unik_subrincian')->index()->unique();
            $table->text('uraian');
            $table->string('kategori_ssh')->nullable();
            $table->integer('kode_kategori_ssh')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b6_subrincian_neracas');
    }
};
