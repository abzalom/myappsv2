<?php

namespace App\Models\Anggaran\Perubahan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan3JenisPerubahan;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Pendapatan2KelompokPerubahan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function jenises(): HasMany
    {
        return $this->hasMany(Pendapatan3JenisPerubahan::class, 'kode_kelompok', 'kode_kelompok');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianPerubahan::class, 'kode_kelompok', 'kode_kelompok');
    }
}
