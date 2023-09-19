<?php

namespace App\Models\Anggaran\Perubahan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan4ObjekPerubahan;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Pendapatan3JenisPerubahan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function objeks(): HasMany
    {
        return $this->hasMany(Pendapatan4ObjekPerubahan::class, 'kode_jenis', 'kode_jenis');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianPerubahan::class, 'kode_jenis', 'kode_jenis');
    }
}
