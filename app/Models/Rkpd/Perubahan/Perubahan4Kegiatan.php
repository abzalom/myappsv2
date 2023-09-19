<?php

namespace App\Models\Rkpd\Perubahan;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rkpd\Perubahan\Perubahan3Program;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perubahan4Kegiatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Perubahan5Subkegiatan::class, 'kode_kegiatan', 'kode_kegiatan');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Perubahan3Program::class, 'kode_program', 'kode_program');
    }
}
