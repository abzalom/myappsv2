<?php

namespace App\Models\Anggaran\Rancangan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Pendapatan1AkunRancangan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the kelompoks for the Pendapatan1AkunRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompoks(): HasMany
    {
        return $this->hasMany(Pendapatan2KelompokRancangan::class, 'kode_akun', 'kode_akun');
    }

    /**
     * Get all of the uraians for the Pendapatan1AkunRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRancangan::class, 'kode_akun', 'kode_akun');
    }
}
