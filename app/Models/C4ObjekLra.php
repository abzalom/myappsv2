<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C4ObjekLra extends Model
{
    use HasFactory;

    /**
     * Get all of the rincians for the C4ObjekLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rincians(): HasMany
    {
        return $this->hasMany(C5RincianLra::class, 'kode_unik_objek', 'kode_unik_objek');
    }

    /**
     * Get the jenis that owns the C4ObjekLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis(): BelongsTo
    {
        return $this->belongsTo(C3JenisLra::class, 'kode_unik_jenis', 'kode_unik_jenis');
    }
}
