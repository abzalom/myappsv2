<?php

namespace App\Models\Anggaran\Rancangan;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Rancangan\Pendapatan7UraianRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan6SubrincianRancangan;

class Pendapatan5RincianRancangan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function subrincians(): HasMany
    {
        return $this->hasMany(Pendapatan6SubrincianRancangan::class, 'kode_rincian', 'kode_rincian');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRancangan::class, 'kode_rincian', 'kode_rincian');
    }
}
