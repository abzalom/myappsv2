<?php

namespace App\Models;

use App\Models\SumberdanaRanwal;
use App\Models\SumberdanaRancangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SumberDana extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $casts = [
        'input' => 'boolean'
    ];

    public function ranwals(): HasMany
    {
        return $this->hasMany(SumberdanaRanwal::class, 'kode_sumberdana', 'kode');
    }

    public function rancangans(): HasMany
    {
        return $this->hasMany(SumberdanaRancangan::class, 'kode_sumberdana', 'kode');
    }

    public function perubahans(): HasMany
    {
        return $this->hasMany(SumberdanaPerubahan::class, 'kode_sumberdana', 'kode');
    }
}
