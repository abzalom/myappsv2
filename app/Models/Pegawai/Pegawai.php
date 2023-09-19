<?php

namespace App\Models\Pegawai;

use App\Models\Opd;
use App\Models\OpdPegawai;
use App\Models\PangkatPegawai;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes;

    // use \Awobaz\Compoships\Compoships;

    protected $guarded = ['id'];

    public function nama(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
        );
    }

    /**
     * Get the user that owns the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }

    /**
     * Get the pangkat associated with the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pangkat(): HasOne
    {
        return $this->hasOne(PangkatPegawai::class, 'id', 'pangkat_pegawai_id');
    }

    /**
     * Get the opdpeg associated with the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function opdpeg(): HasOne
    {
        return $this->hasOne(OpdPegawai::class, 'nip', 'nip')->where('tahun', tahun());
    }
}
