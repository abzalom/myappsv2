<?php

namespace App\Models\Rkpd\Rancangan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rkpd\Rancangan\Rancangan4Kegiatan;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rancangan5Subkegiatan extends Model
{
    use HasFactory, SoftDeletes;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    // protected function jenis(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => strtoupper($value),
    //     );
    // }

    /**
     * Get all of the subkeluarans for the Ranwal5Subkegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkeluarans(): HasMany
    {
        return $this->hasMany(Rancangan6Subkeluaran::class, 'kode_subkegiatan', 'kode_subkegiatan');
    }

    /**
     * Get the kegiatan that owns the Ranwal5Subkegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Rancangan4Kegiatan::class, 'kode_program', 'kode_program');
    }
}
