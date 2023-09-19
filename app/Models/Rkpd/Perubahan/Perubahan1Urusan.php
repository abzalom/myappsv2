<?php

namespace App\Models\Rkpd\Perubahan;

use App\Models\Opd;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Perubahan\Perubahan2Bidang;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perubahan1Urusan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function bidangs(): HasMany
    {
        return $this->hasMany(Perubahan2Bidang::class, 'kode_urusan', 'kode_urusan');
    }

    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Perubahan5Subkegiatan::class, 'kode_urusan', 'kode_urusan');
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'kode_opd', 'kode_opd');
    }
}
