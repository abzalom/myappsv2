<?php

namespace App\Models\Rkpd\Rancangan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rancangan3Program extends Model
{
    use HasFactory;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the kegiatans for the Ranwal3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatans(): HasMany
    {
        return $this->hasMany(Rancangan4Kegiatan::class, 'kode_program', 'kode_program');
    }

    /**
     * Get all of the subkegiatans for the Ranwal3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Rancangan5Subkegiatan::class, 'kode_program', 'kode_program');
    }

    /**
     * Get the bidang that owns the Ranwal3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Rancangan2Bidang::class, 'kode_program', 'kode_program');
    }
}
