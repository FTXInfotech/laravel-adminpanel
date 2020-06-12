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
        // dd($request);
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'publish_datetime'  => $this->publish_datetime->format('d/m/Y h:i A'),
            'status'            => $this->status,
            'created_at'        => optional($this->created_at)->toDateString(),
            'created_by'        => $request->user()->first_name.' '.$request->user()->last_name,
        ];
    }
}
