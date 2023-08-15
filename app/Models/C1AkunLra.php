<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C1AkunLra extends Model
{
    use HasFactory;

    /**
     * Get all of the kelompoks for the C1AkunLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompoks(): HasMany
    {
        return $this->hasMany(C2KelompokLra::class, 'kode_unik_akun', 'kode_unik_akun');
    }
}
