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
        Schema::create('opd_pagus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd');
            // $table->string('kode_uraian');
            $table->string('kode_sumberdana');
            $table->string('jumlah');
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
        Schema::dropIfExists('opd_pagus');
    }
};
