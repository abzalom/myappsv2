<?php

namespace App\Models\Rkpd\Ranwal;

use App\Models\Opd;
use App\Models\OpdPagu;
use App\Models\PaguRanwalOpd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ranwal6Subkeluaran extends Model
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
        return $this->hasOne(PaguRanwalOpd::class, 'kode_unik_sumberdana', 'sumberdana');
    }

    public function subkegiatan(): BelongsTo
    {
        return $this->belongsTo(Ranwal5Subkegiatan::class, 'kode_program', 'kode_program');
    }

    /**
     * Get the opd that owns the Ranwal6Subkeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'kode_opd', 'kode_opd');
    }
}
