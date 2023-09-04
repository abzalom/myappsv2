<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
