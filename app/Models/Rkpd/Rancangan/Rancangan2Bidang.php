<?php

namespace App\Models\Rkpd\Rancangan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Ranwal\Rancangan1Urusan;
use App\Models\Rkpd\Ranwal\Rancangan3Program;
use App\Models\Rkpd\Ranwal\Rancangan5Subkegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rancangan2Bidang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Rancangan3Program::class,  'kode_bidang',  'kode_bidang');
    }

    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Rancangan5Subkegiatan::class, 'kode_bidang',  'kode_bidang');
    }

    public function urusan(): BelongsTo
    {
        return $this->belongsTo(Rancangan1Urusan::class, 'kode_program', 'kode_program');
    }
}
