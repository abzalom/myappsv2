<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A4Kegiatan extends Model
{
    use HasFactory;


    /**
     * Get the program that owns the A4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(A3Program::class, 'kode_program', 'kode_program');
    }

    /**
     * Get all of the subkegiatans for the A4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatans(): HasMany
    {
        return $this->hasMany(A5Subkegiatan::class, 'kode_kegiatan', 'kode_kegiatan');
    }

    /**
     * Get the subkegiatan associated with the A4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subkegiatan(): HasOne
    {
        return $this->hasOne(A4Kegiatan::class, 'kode_kegiatan', 'kode_kegiatan');
    }
}
