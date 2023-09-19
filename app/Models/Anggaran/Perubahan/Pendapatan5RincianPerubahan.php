<?php

namespace App\Models\Anggaran\Perubahan;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use App\Models\Anggaran\Perubahan\Pendapatan6SubrincianPerubahan;

class Pendapatan5RincianPerubahan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function subrincians(): HasMany
    {
        return $this->hasMany(Pendapatan6SubrincianPerubahan::class, 'kode_rincian', 'kode_rincian');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianPerubahan::class, 'kode_rincian', 'kode_rincian');
    }
}
