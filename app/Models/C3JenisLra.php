<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C3JenisLra extends Model
{
    use HasFactory;

    /**
     * Get all of the objeks for the C3JenisLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objeks(): HasMany
    {
        return $this->hasMany(C4ObjekLra::class, 'kode_unik_jenis', 'kode_unik_jenis');
    }

    /**
     * Get the kelompok that owns the C3JenisLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(C2KelompokLra::class, 'kode_unik_kelompok', 'kode_unik_kelompok');
    }
}
