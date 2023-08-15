<?php

namespace App\Models;

use App\Models\A2Bidang;
use App\Models\Scopes\TahunScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpdTag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new TahunScope);
    }

    /**
     * Get the bidang associated with the OpdTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bidang(): HasOne
    {
        return $this->hasOne(A2Bidang::class, 'kode_bidang', 'kode_bidang');
    }
}
