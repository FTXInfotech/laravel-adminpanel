<?php

namespace App\Http\Responses\Backend\Blog;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $status;
    protected $blogTags;
    protected $blogCategories;

    public function __construct($status, $blogCategories, $blogTags)
    {
        $this->status = $status;
        $this->blogTags = $blogTags;
        $this->blogCategories = $blogCategories;
    }

    public function toResponse($request)
    {
        return view('backend.blogs.create')->with([
            'blogCategories' => $this->blogCategories,
            'blogTags'       => $this->blogTags,
            'status'         => $this->status,
        ]);
    }
}
