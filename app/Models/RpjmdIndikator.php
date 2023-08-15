<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class RpjmdIndikator extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the programs for the RpjmdIndikator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programs(): HasMany
    {
        return $this->hasMany(RpjmdProgram::class, 'rpjmd_indikator_id', 'id');
    }

    /**
     * Get the sasaran that owns the RpjmdIndikator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sasaran(): BelongsTo
    {
        return $this->belongsTo(RpjmdSasaran::class, 'rpjmd_sasaran_id', 'id');
    }
}
