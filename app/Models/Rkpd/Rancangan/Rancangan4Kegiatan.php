<?php

namespace App\Models\Rkpd\Rancangan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Rancangan\Rancangan3Program;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rancangan4Kegiatan extends Model
{
    use HasFactory;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the subkegiatans for the Ranwal4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Rancangan5Subkegiatan::class, 'kode_kegiatan', 'kode_kegiatan');
    }

    /**
     * Get the program that owns the Ranwal4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Rancangan3Program::class, 'kode_program', 'kode_program');
    }
}
