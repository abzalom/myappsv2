<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PejabatSekdaCollection extends JsonResource
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
            'nama' => $this->nama,
            'nip' => $this->nip,
            'pangkat' => new PangkatCollection($this->pangkat),
            'tahun' => $this->tahun,
            'active' => $this->active,
        ];
    }

    public function toJson($options = 0)
    {
    }
}
