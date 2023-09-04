<?php

namespace App\Models\Rkpd\Rancangan;

use App\Models\PaguRancanganOpd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rancangan6Subkeluaran extends Model
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
        return $this->hasOne(PaguRancanganOpd::class, 'kode_unik_sumberdana', 'sumberdana');
    }

    public function subkegiatan(): BelongsTo
    {
        return $this->belongsTo(Rancangan5Subkegiatan::class, 'kode_program', 'kode_program');
    }
}
