<?php

namespace App\Models\Sumberpendanaan;

use App\Models\SumberDana;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaguOpd\PaguPerubahanOpd;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SumberdanaPerubahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'jumlah' => 'double',
        'paguranwals_sum_jumlah' => 'double',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    public function sumberdana(): BelongsTo
    {
        return $this->belongsTo(SumberDana::class, 'kode_sumberdana', 'kode');
    }

    public function pagus(): HasMany
    {
        return $this->hasMany(PaguPerubahanOpd::class, 'kode_unik_sumberdana', 'kode_unik');
    }
}
