<?php

namespace App\Models\Anggaran\Ranwal;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Anggaran\Ranwal\Pendapatan3JenisRanwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;

class Pendapatan2KelompokRanwal extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the jenises for the Pendapatan2KelompokRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jenises(): HasMany
    {
        return $this->hasMany(Pendapatan3JenisRanwal::class, 'kode_kelompok', 'kode_kelompok');
    }

    /**
     * Get all of the uraians for the Pendapatan2KelompokRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRanwal::class, 'kode_kelompok', 'kode_kelompok');
    }
}
