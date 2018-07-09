<?php

namespace App\Http\Responses\Backend\BlogCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\BlogCategories\BlogCategory
     */
    protected $blogCategory;

    /**
     * @param \App\Models\BlogCategories\BlogCategory $blogCategory
     */
    public function __construct($blogCategory)
    {
        $this->blogCategory = $blogCategory;
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
        return view('backend.blogcategories.edit')
            ->with('blogcategory', $this->blogCategory);
    }
}
