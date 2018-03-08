<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RoleResource extends Resource
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
            'permission'    => ($this->all) ? 'All' : optional($this->permissions)->pluck('display_name'),
            'noofuses'      => $this->users->count(),
            'sort'          => $this->sort,
        ];
    }
}
