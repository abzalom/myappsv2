<?php

namespace App\Models\Rkpd\Perubahan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Perubahan\Perubahan1Urusan;
use App\Models\Rkpd\Perubahan\Perubahan3Program;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perubahan2Bidang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Perubahan3Program::class,  'kode_bidang',  'kode_bidang');
    }

    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Perubahan5Subkegiatan::class, 'kode_bidang',  'kode_bidang');
    }

    public function urusan(): BelongsTo
    {
        return $this->belongsTo(Perubahan1Urusan::class, 'kode_program', 'kode_program');
    }
}
