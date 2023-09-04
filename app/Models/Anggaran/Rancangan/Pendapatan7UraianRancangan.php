<?php

namespace App\Models\Anggaran\Rancangan;

use Laravel\Scout\Searchable;
use App\Models\PaguRancanganOpd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Rancangan\Pendapatan6SubrincianRancangan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendapatan7UraianRancangan extends Model
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

    public function pagus(): HasMany
    {
        return $this->hasMany(PaguRancanganOpd::class, 'kode_sumberdana', 'kode_sumberdana');
    }

    public function subrincian(): BelongsTo
    {
        return $this->belongsTo(Pendapatan6SubrincianRancangan::class, 'kode_subrincian', 'kode_subrincian');
    }
}
