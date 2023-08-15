<?php

namespace App\Models;

use App\Models\OpdTag;
use App\Models\A1Urusan;
use App\Models\A3Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class A2Bidang extends Model
{
    use HasFactory;

    protected function uraian(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }
    /**
     * Get the urusan that owns the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function urusan(): BelongsTo
    {
        return $this->belongsTo(A1Urusan::class, 'kode_urusan', 'kode_urusan');
    }

    /**
     * Get all of the programs for the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programs(): HasMany
    {
        return $this->hasMany(A3Program::class, 'kode_bidang', 'kode_bidang');
    }

    /**
     * Get the program associated with the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function program(): HasOne
    {
        return $this->hasOne(A3Program::class, 'kode_bidang', 'kode_bidang');
    }

    /**
     * Get the opdtag that owns the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opdtag(): BelongsTo
    {
        return $this->belongsTo(OpdTag::class, 'kode_bidang', 'kode_bidang');
    }
}
