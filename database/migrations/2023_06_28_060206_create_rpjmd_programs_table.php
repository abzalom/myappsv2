<?php

use App\Models\RpjmdIndikator;
use App\Models\RpjmdMisi;
use App\Models\RpjmdVisi;
use App\Models\RpjmdTujuan;
use App\Models\RpjmdPeriode;
use App\Models\RpjmdSasaran;
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
        Schema::create('rpjmd_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RpjmdPeriode::class);
            $table->foreignIdFor(RpjmdVisi::class);
            $table->foreignIdFor(RpjmdMisi::class);
            $table->foreignIdFor(RpjmdTujuan::class);
            $table->foreignIdFor(RpjmdSasaran::class);
            $table->foreignIdFor(RpjmdIndikator::class);
            $table->string('kode_urusan');
            $table->string('kode_bidang');
            $table->string('kode_program');
            // $table->text('uraian');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpjmd_programs');
    }
};
