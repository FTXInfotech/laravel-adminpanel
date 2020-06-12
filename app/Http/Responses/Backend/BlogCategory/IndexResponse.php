<?php

namespace App\Http\Responses\Backend\BlogCategory;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    protected $blogCategory;

    public function __construct($blogCategory)
    {
        $this->blogCategory = $blogCategory;
    }

    public function toResponse($request)
    {
        return view('backend.blog-categories.index')->with([
            'categories'=> $this->blogCategory,
        ]);
    }
}
