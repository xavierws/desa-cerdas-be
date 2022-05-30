<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'phone' => $this->phone,
            'name' => $this->name,
            'role' => $this->role_id,
            'has_merchant' => $this->userable->merchant? true:false
        ];
    }
}
