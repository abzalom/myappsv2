<?php

namespace App\Models;

use App\Models\OpdTag;
use App\Models\OpdPegawai;
use App\Models\PaguRanwalOpd;
use App\Models\PaguRancanganOpd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaguOpd\PaguPerubahanOpd;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use App\Models\Rkpd\Rancangan\Rancangan1Urusan;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Opd extends Model
{
    use HasFactory, SoftDeletes;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];


    public function getRutinAttribute()
    {
        return substr($this->kode_opd, 0, 4);
        // return $this->kode_opd;
    }

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

    public function tags(): HasMany
    {
        return $this->hasMany(OpdTag::class, 'kode_opd', 'kode_opd');
    }

    public function bidangrutin(): HasOne
    {
        return $this->hasOne(OpdTag::class, 'kode_opd', 'kode_opd')->where('rutin', true);
    }

    // Pegawai
    public function opdpeg(): BelongsTo
    {
        return $this->belongsTo(OpdPegawai::class, 'kode_opd', 'kode_opd');
    }

    // Ranwal
    public function paguranwals(): HasMany
    {
        return $this->hasMany(PaguRanwalOpd::class, 'kode_opd', 'kode_opd');
    }

    public function ranwalurusans(): HasMany
    {
        return $this->hasMany(Ranwal1Urusan::class, 'kode_opd', 'kode_opd');
    }

    public function ranwalsubkegiatans(): HasMany
    {
        return $this->hasMany(Ranwal5Subkegiatan::class, 'kode_opd', 'kode_opd');
    }

    public function ranwalsubkeluarans(): HasMany
    {
        return $this->hasMany(Ranwal6Subkeluaran::class, 'kode_opd', 'kode_opd');
    }

    // Rancangan
    public function pagurancangans(): HasMany
    {
        return $this->hasMany(PaguRancanganOpd::class, 'kode_opd', 'kode_opd');
    }

    public function rancanganurusans(): HasMany
    {
        return $this->hasMany(Rancangan1Urusan::class, 'kode_opd', 'kode_opd');
    }

    public function rancangansubkegiatans(): HasMany
    {
        return $this->hasMany(Rancangan5Subkegiatan::class, 'kode_opd', 'kode_opd');
    }

    public function rancangansubkeluarans(): HasMany
    {
        return $this->hasMany(Rancangan6Subkeluaran::class, 'kode_opd', 'kode_opd');
    }

    // Perubahan
    public function paguperubahans(): HasMany
    {
        return $this->hasMany(PaguPerubahanOpd::class, 'kode_opd', 'kode_opd');
    }

    public function perubahansubkegiatans(): HasMany
    {
        return $this->hasMany(Perubahan5Subkegiatan::class, 'kode_opd', 'kode_opd');
    }

    public function perubahansubkeluarans(): HasMany
    {
        return $this->hasMany(Perubahan6Subkeluaran::class, 'kode_opd', 'kode_opd');
    }
}
