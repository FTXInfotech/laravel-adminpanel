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
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'display_status' => $this->display_status,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'created_by' => optional($this->creator)->full_name,
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'updated_by' => optional($this->updater)->full_name,
        ];
    }
}
