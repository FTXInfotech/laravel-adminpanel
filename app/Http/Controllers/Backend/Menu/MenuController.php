<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Models\Menu\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Menu\MenuRepository;
use App\Http\Requests\Backend\Menu\StoreMenuRequest;
use App\Http\Requests\Backend\Menu\ManageMenuRequest;
use App\Http\Requests\Backend\Menu\CreateMenuRequest;
use App\Http\Requests\Backend\Menu\EditMenuRequest;
use App\Http\Requests\Backend\Menu\DeleteMenuRequest;
use App\Http\Requests\Backend\Menu\UpdateMenuRequest;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * @var MenuRepository
     */
    protected $menu;

    /**
     * @param MenuRepository $menu
     */
    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageMenuRequest $request)
    {
        return view('backend.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateMenuRequest $request)
    {
        $types = [
            "backend" => "Backend", 
            "frontend" => "Frontend"
        ];
        $modules = DB::table('modules')->get();
        return view('backend.menus.create')->withTypes($types)->withModules($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $this->menu->create($request->all());

        return redirect()->route('admin.menus.index')->withFlashSuccess(trans('alerts.backend.menus.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, EditMenuRequest $request)
    {
        $types = [
            "backend" => "Backend", 
            "frontend" => "Frontend"
        ];
        $modules = DB::table('modules')->get();
        return view('backend.menus.edit')->withTypes($types)
                                         ->withMenu($menu)
                                         ->withModules($modules);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu, UpdateMenuRequest $request)
    {
        $this->menu->update($menu, $request->all());

        return redirect()->route('admin.menus.index')->withFlashSuccess(trans('alerts.backend.menus.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, DeleteMenuRequest $request)
    {
        $this->menu->delete($menu);

        return redirect()->route('admin.menus.index')->withFlashSuccess(trans('alerts.backend.menus.deleted'));
    }

    /**
     * Get the form for modal popup.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForm($formName, CreateMenuRequest $request)
    {
        if(in_array($formName, ['_add_custom_url_form']))
        {
            return view('backend.menus.'.$formName);
        }
        return abort(404);
    }
}
