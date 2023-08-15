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
        Schema::create('ranwal3_programs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd');
            $table->string('kode_urusan');
            $table->string('kode_bidang');
            $table->string('kode_program');
            $table->text('uraian');
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
        Schema::dropIfExists('ranwal3_programs');
    }
};
