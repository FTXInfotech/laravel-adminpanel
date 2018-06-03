<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Menu\CreateMenuRequest;
use App\Http\Requests\Backend\Menu\DeleteMenuRequest;
use App\Http\Requests\Backend\Menu\EditMenuRequest;
use App\Http\Requests\Backend\Menu\ManageMenuRequest;
use App\Http\Requests\Backend\Menu\StoreMenuRequest;
use App\Http\Requests\Backend\Menu\UpdateMenuRequest;
use App\Http\Responses\Backend\Menu\CreateResponse;
use App\Http\Responses\Backend\Menu\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Menu\Menu;
use App\Repositories\Backend\Menu\MenuRepository;
use Bvipul\Generator\Module;

class MenuController extends Controller
{
    /**
     * Menu Model Object.
     *
     * @var \App\Models\Menu\Menu
     */
    protected $menu;

    /**
     * Module Model Object.
     *
     * @var \Bvipul\Generator\Module
     */
    protected $modules;

    /**
     * Menu Types.
     *
     * @var array
     */
    protected $types;

    /**
     * @param \App\Repositories\Backend\Menu\MenuRepository $menu
     */
    public function __construct(MenuRepository $menu, Module $module)
    {
        $this->menu = $menu;

        $this->modules = $module;

        $this->types = [
            'backend'  => 'Backend',
            'frontend' => 'Frontend',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\Backend\Menu\ManageMenuRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageMenuRequest $request)
    {
        return new ViewResponse('backend.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Http\Requests\Backend\Menu\CreateMenuRequest $request
     *
     * @return \App\Http\Responses\Backend\Menu\CreateResponse
     */
    public function create(CreateMenuRequest $request)
    {
        return new CreateResponse($this->types, $this->modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Menu\StoreMenuRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreMenuRequest $request)
    {
        $this->menu->create($request->except('_token'));

        return new RedirectResponse(route('admin.menus.index'), ['flash_success' => trans('alerts.backend.menus.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Menu\Menu                           $menu
     * @param \App\Http\Requests\Backend\Menu\EditMenuRequest $request
     *
     * @return \App\Http\Responses\Backend\Menu\EditResponse
     */
    public function edit(Menu $menu, EditMenuRequest $request)
    {
        return new EditResponse($menu, $this->types, $this->modules);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Menu\Menu                             $menu
     * @param \App\Http\Requests\Backend\Menu\UpdateMenuRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Menu $menu, UpdateMenuRequest $request)
    {
        $this->menu->update($menu, $request->all());

        return new RedirectResponse(route('admin.menus.index'), ['flash_success' => trans('alerts.backend.menus.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Menu\Menu                             $menu
     * @param \App\Http\Requests\Backend\Menu\DeleteMenuRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Menu $menu, DeleteMenuRequest $request)
    {
        $this->menu->delete($menu);

        return new RedirectResponse(route('admin.menus.index'), ['flash_success' => trans('alerts.backend.menus.deleted')]);
    }
}
