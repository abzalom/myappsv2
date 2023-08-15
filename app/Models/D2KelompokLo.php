<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class D2KelompokLo extends Model
{
    use HasFactory;

    /**
     * Get all of the jenises for the D2KelompokLo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jenises(): HasMany
    {
        return $this->hasMany(D3JenisLo::class, 'kode_unik_kelompok', 'kode_unik_kelompok');
    }
}
