<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class B4ObjekNeraca extends Model
{
    use HasFactory;

    /**
     * Get all of the rincians for the B4ObjekNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rincians(): HasMany
    {
        return $this->hasMany(B5RincianNeraca::class, 'kode_unik_objek', 'kode_unik_objek');
    }
}
