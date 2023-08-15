<?php

namespace App\Models;

use App\Models\PangkatPegawai;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PejabatSekda extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get the pangkat associated with the PejabatSekda
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pangkat(): HasOne
    {
        return $this->hasOne(PangkatPegawai::class, 'id', 'pangkat_pegawai_id');
    }
}
