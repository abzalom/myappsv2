<?php

namespace App\Models\Rkpd\Perubahan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rkpd\Perubahan\Perubahan4Kegiatan;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Perubahan5Subkegiatan extends Model
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

    public function subkeluarans(): HasMany
    {
        return $this->hasMany(Perubahan6Subkeluaran::class, 'kode_subkegiatan', 'kode_subkegiatan');
    }

    public function subkelgaji(): BelongsTo
    {
        return $this->belongsTo(Perubahan6Subkeluaran::class, 'kode_subkegiatan', 'kode_subkegiatan');
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Perubahan4Kegiatan::class, 'kode_program', 'kode_program');
    }

    /**
     * Get the semula associated with the Perubahan5Subkegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function semula(): HasOne
    // {
    //     return $this->hasOne(Rancangan5Subkegiatan::class, 'kode_subkegiatan', 'kode_subkegiatan');
    // }
}
