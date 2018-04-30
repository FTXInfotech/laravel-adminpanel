<?php

namespace App\Http\Responses\Backend\Blog;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $blog,
            $status,
            $blogTags,
            $blogCategories;

    public function __construct($blog, $status, $blogCategories, $blogTags)
    {
        $this->blog = $blog;
        $this->status = $status;
        $this->blogTags = $blogTags;
        $this->blogCategories = $blogCategories;
    }
    
    public function toResponse($request) 
    {
        $selectedCategories = $this->blog->categories->pluck('id')->toArray();
        $selectedtags = $this->blog->tags->pluck('id')->toArray();

        return view('backend.blogs.edit')->with([
            'blog'               => $this->blog,
            'blogCategories'     => $this->blogCategories,
            'blogTags'           => $this->blogTags,
            'selectedCategories' => $selectedCategories,
            'selectedtags'       => $selectedtags,
            'status'             => $this->status,
        ]);
    }

}