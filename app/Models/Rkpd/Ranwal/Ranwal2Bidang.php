<?php

namespace App\Models\Rkpd\Ranwal;

use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ranwal2Bidang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get all of the programs for the Ranwal2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Ranwal3Program::class,  'kode_bidang',  'kode_bidang');
    }

    /**
     * Get all of the subkegiatans for the Ranwal2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatans(): HasMany
    {
        return $this->hasMany(Ranwal5Subkegiatan::class, 'kode_bidang',  'kode_bidang');
    }

    /**
     * Get the urusan that owns the Ranwal2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function urusan(): BelongsTo
    {
        return $this->belongsTo(Ranwal1Urusan::class, 'kode_program', 'kode_program');
    }
}
