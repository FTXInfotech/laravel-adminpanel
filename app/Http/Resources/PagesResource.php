<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PagesResource extends Resource
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
            'title' => $this->title,
            'description' => $this->description,
            'status_label' => $this->status_label,
            'status' => $this->status,
            'display_status' => $this->display_status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'created_by' => optional($this->owner)->full_name,
            'updated_by' => optional($this->updater)->full_name,
        ];
    }
}
