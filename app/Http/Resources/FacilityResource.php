<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'map_url' => $this->map_url,
            'information' => $this->information,
            'category_id' => $this->category_id,
            'category' => $this->category->name,
            'image_url' => $this->image->url,
        ];
    }
}
