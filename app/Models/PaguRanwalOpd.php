<?php

namespace App\Models;

use App\Models\Opd;
use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;


class PaguRanwalOpd extends Model
{
    use HasFactory, SoftDeletes, Searchable;
    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get the opd that owns the PaguRanwalOpd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'kode_opd', 'kode_opd');
    }

    /**
     * Get the uraianpendapatan that owns the PaguRanwalOpd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uraianpendapatan(): BelongsTo
    {
        return $this->belongsTo(Pendapatan7UraianRanwal::class, 'kode_uraian', 'kode_uraian');
    }


    /**
     * Get all of the subkeluarans for the PaguRanwalOpd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkeluarans(): HasMany
    {
        return $this->hasMany(Ranwal6Subkeluaran::class, 'sumberdana', 'kode_uraian');
    }
}
