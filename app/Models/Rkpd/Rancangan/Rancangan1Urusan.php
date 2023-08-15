<?php

namespace App\Models\Rkpd\Rancangan;

use App\Models\Opd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Rancangan\Rancangan2Bidang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Database\Eloquent\Relations\HasMany;

class Rancangan1Urusan extends Model
{
    use HasFactory;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the bidangs for the Rancangan1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidangs(): HasMany
    {
        // return $this->hasMany(Rancangan2Bidang::class, ['kode_opd', 'kode_urusan'], ['kode_opd', 'kode_urusan']);
        return $this->hasMany(Rancangan2Bidang::class, 'kode_urusan', 'kode_urusan');
    }

    /**
     * Get all of the subkegiatans for the Rancangan1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Rancangan5Subkegiatan::class, 'kode_urusan', 'kode_urusan');
    }

    /**
     * Get the opd that owns the Rancangan1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'kode_opd', 'kode_opd');
    }
}
