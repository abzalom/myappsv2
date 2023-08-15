<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class D5RincianLo extends Model
{
    use HasFactory;

    /**
     * Get all of the subrincians for the D5RincianLo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincians(): HasMany
    {
        return $this->hasMany(D6SubrincianLo::class, 'kode_unik_rincian', 'kode_unik_rincian');
    }
}
