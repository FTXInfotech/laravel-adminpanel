<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities\City;
use App\Models\States\State;
use App\Repositories\Frontend\CMSPages\CMSPagesRepository;
use App\Models\Settings\Setting;
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
     * Used to get the states of default country
     * 
     * @param Request $request
     * @return JSON
     */
    public function getStates(Request $request)
    {
        $states = State::where("country_id", config("access.constants.default_country"))
            ->pluck('state', 'id')->toArray();
        return array(
            "status" => "state",
            "data" => $states
        );
    }

    /**
     * Used to get the cities of selected state
     * 
     * @param Request $request
     * @return JSON
     */
    public function getCities(Request $request)
    {
        $cities = City::where("state_id", $request->stateId)->pluck('city', 'id')
            ->toArray();
        return array(
            "status" => "city",
            "data" => $cities
        );
    }
    /**
    * show cmspage by pageslug 
    */
    public function showCMSPage($page_slug,CMSPagesRepository $RepositoryContract) {
        $result = $RepositoryContract->findBySlug($page_slug);
        return view('frontend.cmspages.index')
			->withCmspages($result);
    }
}
