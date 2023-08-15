<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class B1AkunNeraca extends Model
{
    use HasFactory;

    /**
     * Get all of the kelompoks for the B1AkunNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompoks(): HasMany
    {
        return $this->hasMany(B2KelompokNeraca::class, 'kode_unik_akun', 'kode_unik_akun');
    }
}
