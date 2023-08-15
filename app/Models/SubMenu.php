<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function roles(): Attribute
    {
        return Attribute::make(
            function (string $value) {
                $data = explode(',', $value);
                if (empty(trim($data[count($data) - 1]))) {
                    unset($data[count($data) - 1]);
                }
                return $data;
            }
        );
    }

    /**
     * Get the menu that owns the SubMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
