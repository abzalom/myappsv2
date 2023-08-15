<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RpjmdTujuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the sasarans for the RpjmdTujuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sasarans(): HasMany
    {
        return $this->hasMany(RpjmdSasaran::class, 'rpjmd_tujuan_id', 'id');
    }

    /**
     * Get the misi that owns the RpjmdTujuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function misi(): BelongsTo
    {
        return $this->belongsTo(RpjmdMisi::class, 'rpjmd_misi_id', 'id');
    }
}
