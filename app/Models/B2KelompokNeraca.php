<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class B2KelompokNeraca extends Model
{
    use HasFactory;

    /**
     * Get all of the jenises for the B2KelompokNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jenises(): HasMany
    {
        return $this->hasMany(B3JenisNeraca::class, 'kode_unik_kelompok', 'kode_unik_kelompok');
    }
}
