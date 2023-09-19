<?php

namespace App\Models\PaguOpd;

use App\Models\Opd;
use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;

class PaguPerubahanOpd extends Model
{
    use HasFactory, SoftDeletes, Searchable;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'kode_opd', 'kode_opd');
    }

    public function uraianpendapatan(): BelongsTo
    {
        return $this->belongsTo(Pendapatan7UraianPerubahan::class, 'kode_uraian', 'kode_uraian');
    }

    public function subkeluarans(): HasMany
    {
        return $this->hasMany(Perubahan6Subkeluaran::class, 'sumberdana', 'kode_unik_sumberdana');
    }

    public function menjadi_subkeluarans(): HasMany
    {
        return $this->hasMany(Perubahan6Subkeluaran::class, 'menjadi_sumberdana', 'kode_unik_sumberdana');
    }

    public function sumberdanas(): HasMany
    {
        return $this->hasMany(SumberdanaPerubahan::class, 'id', 'sumberdana_ranwal_id');
    }

    public function sumberdana(): BelongsTo
    {
        return $this->belongsTo(SumberdanaPerubahan::class, 'kode_sumberdana', 'kode_sumberdana');
    }
}
