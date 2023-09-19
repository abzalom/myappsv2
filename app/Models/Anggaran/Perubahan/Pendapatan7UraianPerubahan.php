<?php

namespace App\Models\Anggaran\Perubahan;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaguOpd\PaguPerubahanOpd;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan6SubrincianPerubahan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendapatan7UraianPerubahan extends Model
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
        return $this->hasMany(PaguPerubahanOpd::class, 'kode_sumberdana', 'kode_sumberdana');
    }

    public function subrincian(): BelongsTo
    {
        return $this->belongsTo(Pendapatan6SubrincianPerubahan::class, 'kode_subrincian', 'kode_subrincian');
    }
}
