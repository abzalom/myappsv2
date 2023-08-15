<?php

use App\Models\PejabatSekda;
use App\Models\PejabatSementara;
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
        Schema::create('rpjmd_periodes', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(PejabatSementara::class)->nullable();
            // $table->foreignIdFor(PejabatSekda::class)->nullable();
            $table->boolean('active')->default(false);
            $table->year('awal');
            $table->year('akhir');
            $table->string('kdh');
            // $table->boolean('kdh_active')->default(false);
            $table->string('wkdh');
            // $table->boolean('wkdh_active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpjmd_periodes');
    }
};
