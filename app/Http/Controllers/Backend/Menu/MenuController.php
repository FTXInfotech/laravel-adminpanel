<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Menu\CreateMenuRequest;
use App\Http\Requests\Backend\Menu\DeleteMenuRequest;
use App\Http\Requests\Backend\Menu\EditMenuRequest;
use App\Http\Requests\Backend\Menu\ManageMenuRequest;
use App\Http\Requests\Backend\Menu\StoreMenuRequest;
use App\Http\Requests\Backend\Menu\UpdateMenuRequest;
use App\Models\Menu\Menu;
use App\Repositories\Backend\Menu\MenuRepository;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    protected $menu;

    /**
     * @param \App\Repositories\Backend\Menu\MenuRepository $menu
     */
    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\Backend\Menu\ManageMenuRequest $request
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
     * @param \App\Http\Requests\Backend\Menu\CreateMenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateMenuRequest $request)
    {
        $types = [
            'backend'  => 'Backend',
            'frontend' => 'Frontend',
        ];
        $modules = DB::table('modules')->get();

        return view('backend.menus.create')->withTypes($types)->withModules($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Menu\StoreMenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $this->menu->create($request->except('_token'));

        return redirect()->route('admin.menus.index')->withFlashSuccess(trans('alerts.backend.menus.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Menu\Menu                           $menu
     * @param \App\Http\Requests\Backend\Menu\EditMenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, EditMenuRequest $request)
    {
        $types = [
            'backend'  => 'Backend',
            'frontend' => 'Frontend',
        ];

        $modules = DB::table('modules')->get();

        return view('backend.menus.edit')
                ->with('types', $types)
                ->with('menu', $menu)
                ->with('modules', $modules);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Menu\Menu                             $menu
     * @param \App\Http\Requests\Backend\Menu\UpdateMenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu, UpdateMenuRequest $request)
    {
        $this->menu->update($menu, $request->all());

        return redirect()
            ->route('admin.menus.index')
            ->with('flash_success', trans('alerts.backend.menus.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Menu\Menu                             $menu
     * @param \App\Http\Requests\Backend\Menu\DeleteMenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, DeleteMenuRequest $request)
    {
        $this->menu->delete($menu);

        return redirect()
            ->route('admin.menus.index')
            ->with('flash_success', trans('alerts.backend.menus.deleted'));
    }
}
