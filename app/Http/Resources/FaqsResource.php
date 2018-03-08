<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FaqsResource extends Resource
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
            'question'      => $this->question,
            'answer'        => $this->answer,
            'status'        => $this->status,
            'created_at'    => $this->created_at->toIso8601String(),
        ];
    }
}
