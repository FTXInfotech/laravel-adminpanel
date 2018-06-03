<?php

namespace App\Http\Responses\Backend\Menu;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
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
     * @param array                    $types
     * @param \Bvipul\Generator\Module $modules
     */
    public function __construct($types, $modules)
    {
        $this->types = $types;
        $this->modules = $modules;
    }

    /**
     * In Response.
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.menus.create')
            ->withTypes($this->types)
            ->withModules($this->modules->all());
    }
}
