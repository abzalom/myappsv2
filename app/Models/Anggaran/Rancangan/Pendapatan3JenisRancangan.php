<?php

namespace App\Models\Anggaran\Rancangan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Rancangan\Pendapatan4ObjekRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan7UraianRancangan;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Pendapatan3JenisRancangan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function objeks(): HasMany
    {
        return $this->hasMany(Pendapatan4ObjekRancangan::class, 'kode_jenis', 'kode_jenis');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRancangan::class, 'kode_jenis', 'kode_jenis');
    }
}
