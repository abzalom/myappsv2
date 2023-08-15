<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'menu_id' => $this->menu_id,
            'sub_name' => $this->sub_name,
            'sub_link' => $this->sub_link,
            'roles' => $this->roles,
        ];
    }
}
