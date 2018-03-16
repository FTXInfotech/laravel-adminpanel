<?php

namespace App\Http\Controllers\frontend\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogTags\BlogTag;


class SearchController extends Controller
{
    public function search()
    {
        $blogtags=BlogTag::get()->all();
    	return view('frontend.search.index',compact('blogtags'));
    }
}
