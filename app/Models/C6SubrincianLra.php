<?php

namespace App\Models;

use App\Models\Anggaran\Ranwal\Pendapatan6SubrincianRanwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class C6SubrincianLra extends Model
{
    use HasFactory, Searchable;

    public function toSearchableArray(): array
    {
        return [
            'kode_unik_subrincian' => $this->kode_unik_subrincian,
            'uraian' => $this->uraian,
        ];
    }

    /**
     * Get the pendapatansubs associated with the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pendapatansubs(): HasOne
    {
        return $this->hasOne(Pendapatan6SubrincianRanwal::class, 'kode_unik_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get the rincian that owns the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rincian(): BelongsTo
    {
        return $this->belongsTo(C5RincianLra::class, 'kode_unik_rincian', 'kode_unik_rincian');
    }
}
