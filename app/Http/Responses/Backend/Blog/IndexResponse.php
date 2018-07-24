<?php

namespace App\Http\Responses\Backend\Blog;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function toResponse($request)
    {
        return view('backend.blogs.index')->with([
            'status'=> $this->status,
        ]);
    }
}
