<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C2KelompokLra extends Model
{
    use HasFactory;

    /**
     * Get all of the jenises for the C2KelompokLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jenises(): HasMany
    {
        return $this->hasMany(C3JenisLra::class, 'kode_unik_kelompok', 'kode_unik_kelompok');
    }

    /**
     * Get the akun that owns the C2KelompokLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function akun(): BelongsTo
    {
        return $this->belongsTo(C1AkunLra::class, 'kode_unik_akun', 'kode_unik_akun');
    }
}
