<?php

namespace App\Models\Anggaran\Ranwal;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Anggaran\Ranwal\Pendapatan4ObjekRanwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;

class Pendapatan3JenisRanwal extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the objeks for the Pendapatan3JenisRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objeks(): HasMany
    {
        return $this->hasMany(Pendapatan4ObjekRanwal::class, 'kode_jenis', 'kode_jenis');
    }

    /**
     * Get all of the uraians for the Pendapatan3JenisRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRanwal::class, 'kode_jenis', 'kode_jenis');
    }
}
