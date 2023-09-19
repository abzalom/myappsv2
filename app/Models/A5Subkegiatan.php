<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class A5Subkegiatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the kegiatan that owns the A5Subkegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(A4Kegiatan::class, 'kode_kegiatan', 'kode_kegiatan');
    }
}
