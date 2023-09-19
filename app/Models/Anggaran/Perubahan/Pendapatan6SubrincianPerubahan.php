<?php

namespace App\Models\Anggaran\Perubahan;

use Laravel\Scout\Searchable;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Anggaran\Perubahan\Pendapatan7UraianPerubahan;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendapatan6SubrincianPerubahan extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function uraians(): HasMany
    {
        return $this->hasMany(Pendapatan7UraianPerubahan::class, 'kode_subrincian', 'kode_subrincian');
    }
}
