<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RpjmdVisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the misis for the RpjmdVisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function misis(): HasMany
    {
        return $this->hasMany(RpjmdMisi::class, 'rpjmd_visi_id', 'id');
    }

    /**
     * Get the periode that owns the RpjmdVisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periode(): BelongsTo
    {
        return $this->belongsTo(RpjmdPeriode::class, 'rpjmd_periode_id', 'id');
    }
}
