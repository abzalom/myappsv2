<?php

use App\Models\PangkatPegawai;
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
        Schema::create('pejabat_sekdas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('nip');
            $table->foreignIdFor(PangkatPegawai::class);
            $table->year('tahun');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat_sekdas');
    }
};
