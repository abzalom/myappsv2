<?php

use App\Models\SumberdanaRanwal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagu_rancangan_opds', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd');
            $table->string('kode_sumberdana');
            $table->string('kode_unik_sumberdana');
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
        Schema::dropIfExists('pagu_rancangan_opds');
    }
};
