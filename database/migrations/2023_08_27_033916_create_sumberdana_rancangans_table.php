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
        Schema::create('sumberdana_rancangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sumberdana');
            $table->integer('nomor');
            $table->string('kode_unik');
            $table->text('uraian');
            $table->decimal('jumlah', 16, 2);
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
        Schema::dropIfExists('sumberdana_rancangans');
    }
};
