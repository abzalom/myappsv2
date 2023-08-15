<?php

namespace App\Models\Rkpd\Ranwal;

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

    /**
     * Get the pagu associated with the Ranwal6Subkeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pagu(): HasOne
    {
        return $this->hasOne(PaguRanwalOpd::class, 'kode_uraian', 'sumberdana');
    }

    /**
     * Get the subkegiatan that owns the Ranwal6Subkeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subkegiatan(): BelongsTo
    {
        return $this->belongsTo(Ranwal5Subkegiatan::class, 'kode_program', 'kode_program');
    }
}
