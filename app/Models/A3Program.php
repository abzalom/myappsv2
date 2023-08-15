<?php

namespace App\Models;

use App\Models\A2Bidang;
use App\Models\A4Kegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class A3Program extends Model
{
    use HasFactory;

    protected function uraian(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }

    /**
     * Get the bidang that owns the A3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(A2Bidang::class, 'kode_bidang', 'kode_bidang');
    }

    /**
     * Get all of the kegiatans for the A3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatans(): HasMany
    {
        return $this->hasMany(A4Kegiatan::class, 'kode_program', 'kode_program');
    }

    /**
     * Get the kegiatan associated with the A3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kegiatan(): HasOne
    {
        return $this->hasOne(A4Kegiatan::class, 'kode_program', 'kode_program');
    }
}
