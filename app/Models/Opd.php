<?php

namespace App\Models;

use App\Models\Rkpd\Rancangan\Rancangan1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opd extends Model
{
    use HasFactory, SoftDeletes;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    protected function namaOpd(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }

    public function getNamaLowerAttribute()
    {
        return strtolower($this->nama_opd);
        // return $this->title = ucwords($this->nama_opd);
    }

    /**
     * Get all of the tags for the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(OpdTag::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get all of the pagus for the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagus(): HasMany
    {
        return $this->hasMany(PaguRanwalOpd::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get all of the urusans for the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranwalurusans(): HasMany
    {
        return $this->hasMany(Ranwal1Urusan::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get all of the urusans for the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rancanganurusans(): HasMany
    {
        return $this->hasMany(Rancangan1Urusan::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get all of the ranwalsubkegiatans for the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranwalsubkegiatans(): HasMany
    {
        return $this->hasMany(Ranwal5Subkegiatan::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get all of the subkeluarans for the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranwalsubkeluarans(): HasMany
    {
        return $this->hasMany(Ranwal6Subkeluaran::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get the opdpeg that owns the Opd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opdpeg(): BelongsTo
    {
        return $this->belongsTo(OpdPegawai::class, 'kode_opd', 'kode_opd');
    }
}