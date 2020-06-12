<?php

namespace App\Http\Responses\Backend\BlogTag;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\BlogTags\BlogCategory
     */
    protected $blogTag;

    /**
     * @param \App\Models\BlogTags\BlogTag $blogTag
     */
    public function __construct($blogTag)
    {
        $this->blogTag = $blogTag;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.blog-tags.edit')
            ->with('blogTag', $this->blogTag);
    }
}
