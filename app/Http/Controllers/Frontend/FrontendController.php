<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\Repositories\Frontend\CMSPages\CMSPagesRepository;

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

    /**
     * show cmspage by pageslug.
     */
    public function showCMSPage($page_slug, CMSPagesRepository $RepositoryContract)
    {
        $result = $RepositoryContract->findBySlug($page_slug);

        return view('frontend.cmspages.index')
            ->withCmspages($result);
    }
}
