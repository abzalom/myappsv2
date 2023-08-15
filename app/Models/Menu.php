<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the submenu for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

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

    public function submenu(): HasMany
    {
        return $this->hasMany(SubMenu::class, 'menu_id', 'id');
    }
}
