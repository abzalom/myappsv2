<?php

namespace App\Models;

use App\Models\A2Bidang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class A1Urusan extends Model
{
    use HasFactory;

    protected function uraian(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }

    /**
     * Get all of the bidangs for the A1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidangs(): HasMany
    {
        return $this->hasMany(A2Bidang::class, 'kode_urusan', 'kode_urusan');
    }

    /**
     * Get the bidang associated with the A1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bidang(): HasOne
    {
        return $this->hasOne(A2Bidang::class, 'kode_urusan', 'kode_urusan');
    }
}
