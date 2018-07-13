<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BlogCategoriesResource extends Resource
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
            'status'        => ($this->isActive()) ? 'Active' : 'InActive',
            'created_at'    => optional($this->created_at)->toDateString(),
            'created_by'    => (isset($this->creator)) ? optional($this->creator)->first_name : $this->user_name,
        ];
    }
}
