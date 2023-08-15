<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class D1AkunLo extends Model
{
    use HasFactory;

    /**
     * Get all of the kelompoks for the D1AkunLo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompoks(): HasMany
    {
        return $this->hasMany(D2KelompokLo::class, 'kode_unik_akun', 'kode_unik_akun');
    }
}
