<?php

namespace App\Models\Anggaran\Ranwal;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan5RincianRanwal;

class Pendapatan4ObjekRanwal extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function rincians(): HasMany
    {
        return $this->hasMany(Pendapatan5RincianRanwal::class, 'kode_objek', 'kode_objek');
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRanwal::class, 'kode_objek', 'kode_objek');
    }
}
