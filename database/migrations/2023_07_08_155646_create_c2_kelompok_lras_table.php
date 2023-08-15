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
        Schema::create('c2_kelompok_lras', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index()->unique();
            $table->text('uraian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c2_kelompok_lras');
    }
};
