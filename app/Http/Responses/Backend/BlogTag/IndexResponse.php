<?php

namespace App\Http\Responses\Backend\BlogTag;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    protected $blogTags;

    public function __construct($blogTags)
    {
        $this->blogTags = $blogTags;
    }

    public function toResponse($request)
    {
        return view('backend.blog-tags.index')->with([
            'tags'=> $this->blogTags,
        ]);
    }
}
