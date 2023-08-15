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
        Schema::create('jadwal_rkpds', function (Blueprint $table) {
            $table->id();
            $table->enum('tahapan', ['ranwal', 'rancangan', 'penetapan']);
            $table->text('keterangan')->nullable();
            $table->timestamp('mulai');
            $table->timestamp('selesai');
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
        Schema::dropIfExists('jadwal_rkpds');
    }
};
