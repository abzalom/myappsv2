<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class B5RincianNeraca extends Model
{
    use HasFactory;

    /**
     * Get all of the subrincians for the B5RincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincians(): HasMany
    {
        return $this->hasMany(B6SubrincianNeraca::class, 'kode_unik_rincian', 'kode_unik_rincian');
    }
}
