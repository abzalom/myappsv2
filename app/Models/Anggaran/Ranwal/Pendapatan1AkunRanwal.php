<?php

namespace App\Models\Anggaran\Ranwal;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan2KelompokRanwal;

class Pendapatan1AkunRanwal extends Model
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
        return $this->hasMany(Pendapatan2KelompokRanwal::class, 'kode_akun', 'kode_akun');
    }

    /**
     * Get all of the uraians for the Pendapatan1AkunRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianRanwal::class, 'kode_akun', 'kode_akun');
    }
}
