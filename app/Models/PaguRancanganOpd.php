<?php

namespace App\Models;

use App\Models\Opd;
use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use App\Models\SumberdanaRancangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Rancangan\Pendapatan7UraianRancangan;

class PaguRancanganOpd extends Model
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
        return $this->belongsTo(Pendapatan7UraianRancangan::class, 'kode_uraian', 'kode_uraian');
    }

    public function subkeluarans(): HasMany
    {
        return $this->hasMany(Rancangan6Subkeluaran::class, 'sumberdana', 'kode_unik_sumberdana');
    }

    public function sumberdanas(): HasMany
    {
        return $this->hasMany(SumberdanaRancangan::class, 'id', 'sumberdana_ranwal_id');
    }

    public function sumberdana(): BelongsTo
    {
        return $this->belongsTo(SumberdanaRancangan::class, 'kode_sumberdana', 'kode_sumberdana');
    }
}
