<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class B3JenisNeraca extends Model
{
    use HasFactory;

    /**
     * Get all of the objeks for the B3JenisNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objeks(): HasMany
    {
        return $this->hasMany(B4ObjekNeraca::class, 'kode_unik_jenis', 'kode_unik_jenis');
    }
}
