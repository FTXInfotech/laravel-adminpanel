<?php

namespace App\Http\Responses\Backend\Menu;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var array
     */
    protected $types;

    /**
     * @var \Bvipul\Generator\Module
     */
    protected $modules;

    /**
     * @var \App\Models\Menu\Menu
     */
    protected $menu;

    /**
     * @param \App\Models\Menu\Menu    $menu
     * @param array                    $types
     * @param \Bvipul\Generator\Module $modules
     */
    public function __construct($menu, $types, $modules)
    {
        $this->menu = $menu;
        $this->types = $types;
        $this->modules = $modules;
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
        return view('backend.menus.edit')
                ->with('types', $this->types)
                ->with('menu', $this->menu)
                ->with('modules', $this->modules->all());
    }
}
