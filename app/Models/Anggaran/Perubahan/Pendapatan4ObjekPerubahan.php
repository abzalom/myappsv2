<?php

namespace App\Models\Anggaran\Perubahan;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use App\Models\Anggaran\Perubahan\Pendapatan5RincianPerubahan;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendapatan4ObjekPerubahan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function rincians(): HasMany
    {
        return $this->hasMany(Pendapatan5RincianPerubahan::class, 'kode_objek', 'kode_objek');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianPerubahan::class, 'kode_objek', 'kode_objek');
    }
}
