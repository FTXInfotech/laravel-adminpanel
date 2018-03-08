<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PermissionResource extends Resource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'display_name'  => $this->display_name,
            'sort'          => $this->sort,
        ];
    }
}
