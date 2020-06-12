<?php

namespace App\Http\Responses\Backend\Blogs;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    protected $status;

    protected $blogs;

    public function __construct($status, $blogs)
    {
        $this->status = $status;
        $this->blogs = $blogs;
    }

    public function toResponse($request)
    {
        return view('backend.blogs.index')->with([
            'status'=> $this->status,
            'blogs' => $this->blogs
        ]);
    }
}
