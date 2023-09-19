<?php

namespace App\Models\Rkpd\Perubahan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Perubahan\Perubahan2Bidang;
use App\Models\Rkpd\Perubahan\Perubahan4Kegiatan;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perubahan3Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function kegiatans(): HasMany
    {
        return $this->hasMany(Perubahan4Kegiatan::class, 'kode_program', 'kode_program');
    }

    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Perubahan5Subkegiatan::class, 'kode_program', 'kode_program');
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Perubahan2Bidang::class, 'kode_program', 'kode_program');
    }
}
