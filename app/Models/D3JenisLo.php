<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class D3JenisLo extends Model
{
    use HasFactory;

    /**
     * Get all of the objeks for the D3JenisLo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objeks(): HasMany
    {
        return $this->hasMany(D4ObjekLo::class, 'kode_unik_jenis', 'kode_unik_jenis');
    }
}
