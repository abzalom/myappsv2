<?php

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
        Schema::create('rpjmd_indikators', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RpjmdPeriode::class);
            $table->foreignIdFor(RpjmdVisi::class);
            $table->foreignIdFor(RpjmdMisi::class);
            $table->foreignIdFor(RpjmdTujuan::class);
            $table->foreignIdFor(RpjmdSasaran::class);
            $table->text('indikator')->nullable();
            $table->string('satuan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpjmd_indikators');
    }
};
