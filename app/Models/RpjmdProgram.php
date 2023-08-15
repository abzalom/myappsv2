<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RpjmdProgram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the nomens for the RpjmdProgram
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nomen(): HasOne
    {
        return $this->hasOne(A3Program::class, 'kode_program', 'kode_program');
    }

    /**
     * Get the indikator that owns the RpjmdProgram
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indikator(): BelongsTo
    {
        return $this->belongsTo(RpjmdIndikator::class, 'rpjmd_indikator_id', 'id');
    }
}
