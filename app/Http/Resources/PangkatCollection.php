<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PangkatCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'pangkat' => str($this->pangkat)->title(),
            'golongan' =>  $this->golongan . '/' . str($this->ruang)->lower(),
        ];
    }

    public function toJson($options = 0)
    {
    }
}
