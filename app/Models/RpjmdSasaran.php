<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class RpjmdSasaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the indikators for the RpjmdSasaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indikators(): HasMany
    {
        return $this->hasMany(RpjmdIndikator::class, 'rpjmd_sasaran_id', 'id');
    }

    /**
     * Get the tujuan that owns the RpjmdSasaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(RpjmdTujuan::class, 'rpjmd_tujuan_id', 'id');
    }
}
