<?php

namespace App\Models\Anggaran\Ranwal;

use App\Models\OpdPagu;
use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Ranwal\Pendapatan6SubrincianRanwal;
use App\Models\PaguRanwalOpd;

class Pendapatan7UraianRanwal extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];
    protected $casts = [
        'jumlah' => 'float'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function toSearchableArray(): array
    {
        return [
            'kode_uraian' => $this->kode_uraian,
            'uraian' => $this->uraian,
            'jumlah' => $this->jumlah,
        ];
    }

    /**
     * Get all of the pagus for the Pendapatan7UraianRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagus(): HasMany
    {
        return $this->hasMany(PaguRanwalOpd::class, 'kode_uraian', 'kode_uraian');
    }

    /**
     * Get the subrincian that owns the Pendapatan7UraianRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subrincian(): BelongsTo
    {
        return $this->belongsTo(Pendapatan6SubrincianRanwal::class, 'kode_subrincian', 'kode_subrincian');
    }
}
