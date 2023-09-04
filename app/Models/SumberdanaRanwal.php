<?php

namespace App\Models;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SumberdanaRanwal extends Model
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

    public function paguranwals(): HasMany
    {
        return $this->hasMany(PaguRanwalOpd::class, 'kode_unik_sumberdana', 'kode_unik');
    }
}
