<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FacilityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'status' => 200,
            'success' => true,
            'message' => 'data berhasil diambil',
            'data' => $this->collection,
        ];
    }
}
