<?php

namespace App\Models\Rkpd\Perubahan;

use App\Models\Opd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaguOpd\PaguPerubahanOpd;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perubahan6Subkeluaran extends Model
{
    use HasFactory, SoftDeletes;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function pagu(): HasOne
    {
        return $this->hasOne(PaguPerubahanOpd::class, 'kode_unik_sumberdana', 'sumberdana');
    }

    public function menjadi_pagu(): HasOne
    {
        return $this->hasOne(PaguPerubahanOpd::class, 'kode_unik_sumberdana', 'menjadi_sumberdana');
    }

    public function subkegiatan(): BelongsTo
    {
        return $this->belongsTo(Perubahan5Subkegiatan::class, 'kode_program', 'kode_program');
    }

    /**
     * Get the opd that owns the Perubahan6Subkeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'kode_opd', 'kode_opd');
    }

    // public function semula(): HasOne
    // {
    //     return $this->hasOne(Rancangan6Subkeluaran::class, 'kode_subkeluaran', 'kode_subkeluaran');
    // }
}
