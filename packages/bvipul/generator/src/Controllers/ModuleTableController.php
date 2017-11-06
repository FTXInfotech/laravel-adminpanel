<?php

namespace Bvipul\Generator\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Bvipul\Generator\Repositories\ModuleRepository;

class ModuleTableController extends Controller
{
    /**
     * @var ModuleRepository
     */
    protected $module;

    /**
     * @param ModuleRepository $module
     */
    public function __construct(ModuleRepository $module)
    {
        $this->module = $module;
    }

    /**
     * @param Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return Datatables::of($this->module->getForDataTable())
            ->escapeColumns(['name', 'url', 'view_permission_id'])
            ->addColumn('created_by', function ($module) {
                return $module->created_by;
            })
            ->make(true);
    }
}
