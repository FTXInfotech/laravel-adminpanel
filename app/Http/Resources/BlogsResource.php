<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BlogsResource extends Resource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'publish_datetime'  => $this->publish_datetime->format('d/m/Y h:i A'),
            'status'            => $this->status,
            'created_at'        => optional($this->created_at)->toDateString(),
            'created_by'        => (is_null($this->user_name)) ? optional($this->owner)->first_name : $this->user_name,
        ];
    }
}
