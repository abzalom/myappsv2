<?php

namespace App\Models\Anggaran\Perubahan;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use App\Models\Anggaran\Perubahan\Pendapatan2KelompokPerubahan;

class Pendapatan1AkunPerubahan extends Model
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
        return $this->hasMany(Pendapatan2KelompokPerubahan::class, 'kode_akun', 'kode_akun');
    }

    /**
     * Get all of the uraians for the Pendapatan1AkunRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianPerubahan::class, 'kode_akun', 'kode_akun');
    }
}
