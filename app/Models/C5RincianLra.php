<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C5RincianLra extends Model
{
    use HasFactory;

    /**
     * Get all of the subrincians for the C5RincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincians(): HasMany
    {
        return $this->hasMany(C6SubrincianLra::class, 'kode_unik_rincian', 'kode_unik_rincian');
    }

    /**
     * Get the objek that owns the C5RincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objek(): BelongsTo
    {
        return $this->belongsTo(C4ObjekLra::class, 'kode_unik_objek', 'kode_unik_objek');
    }
}
