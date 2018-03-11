<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'first_name'      => $this->first_name,
            'last_name'       => $this->last_name,
            'email'           => $this->email,
            'confirmed'       => $this->confirmed,
            'role'            => optional($this->roles()->first())->name,
            'registered_at'   => $this->created_at->toIso8601String(),
            'last_updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
