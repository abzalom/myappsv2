<?php

namespace App\Models;

use App\Models\Pegawai\Pegawai;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OpdPegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get the pegawai that owns the OpdPegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }

    /**
     * Get the opd that owns the OpdPegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function opd(): HasOne
    {
        return $this->hasOne(Opd::class, 'kode_opd', 'kode_opd');
    }
}
