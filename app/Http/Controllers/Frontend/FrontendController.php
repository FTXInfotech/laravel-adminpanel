<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\Repositories\Frontend\Pages\PagesRepository;
use App\Models\Blogs\Blog;
use App\Models\BlogCategories\BlogCategory;
use App\Models\BlogTags\BlogTag;
/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settingData = Setting::first();
        $google_analytics = $settingData->google_analytics;

        return view('frontend.index', compact('google_analytics', $google_analytics));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function about()
    {
        $blogtags=BlogTag::get()->all();
        return view('frontend.layouts.about',compact('blogtags'));
    }

     public function contact()
    {
        $blogtags=BlogTag::get()->all();
        return view('frontend.layouts.contact',compact('blogtags'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function blogindex()
    {
        // dd('here');
        $blogs = Blog::latest()->paginate(3);
        $blogcategories=BlogCategory::get()->all();
        $blogtags=BlogTag::get()->all();
        return view('frontend.blogs.index',compact('blogs','blogcategories','blogtags','archives'));
    }



      public function search($id)
    {
        $BlogTags=new BlogTag;
        $blog=new Blog;
        $id=request('value');
        dd($id);
        $blogs=BlogTag::with('blogs')->whereIn('id', $BlogTags)->groupBy('id')->get();
        
        return view('frontend.blogs.index',compact('blogs'));
    }

   public function showBlog(Blog $blog)
    {
          $blogtags=BlogTag::get()->all();
         return view('frontend.blogs.showBlog',compact('blog','blogtags'));
    }


    /**
     * show page by $page_slug.
     */
    public function showPage($slug, PagesRepository $pages)
    {
        $result = $pages->findBySlug($slug);

        return view('frontend.pages.index')
            ->withpage($result);
    }
}
