<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class D4ObjekLo extends Model
{
    use HasFactory;

    /**
     * Get all of the rincians for the D4ObjekLo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rincians(): HasMany
    {
        return $this->hasMany(D5RincianLo::class, 'kode_unik_objek', 'kode_unik_objek');
    }
}
