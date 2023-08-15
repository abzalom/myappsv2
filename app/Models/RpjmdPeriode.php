<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RpjmdPeriode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'boolean',
        'kdh_active' => 'boolean',
        'wkdh_active' => 'boolean',
    ];

    /**
     * Get all of the visis for the RpjmdPeriode
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visis(): HasMany
    {
        return $this->hasMany(RpjmdVisi::class, 'rpjmd_periode_id', 'id');
    }
}
