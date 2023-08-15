<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RpjmdMisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the tujuans for the RpjmdMisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tujuans(): HasMany
    {
        return $this->hasMany(RpjmdTujuan::class, 'rpjmd_misi_id', 'id');
    }

    /**
     * Get the visi that owns the RpjmdMisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visi(): BelongsTo
    {
        return $this->belongsTo(RpjmdVisi::class, 'rpjmd_visi_id', 'id');
    }
}
