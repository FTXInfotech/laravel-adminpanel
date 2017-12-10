<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Menu\ManageMenuRequest;
use App\Repositories\Backend\Menu\MenuRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class MenuTableController.
 */
class MenuTableController extends Controller
{
    protected $menus;

    /**
     * @param \App\Repositories\Backend\Menu\MenuRepository $menus
     */
    public function __construct(MenuRepository $menus)
    {
        $this->menus = $menus;
    }

    /**
     * @param \App\Http\Requests\Backend\Menu\ManageMenuRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageMenuRequest $request)
    {
        return Datatables::of($this->menus->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('type', function ($menus) {
                return ucwords($menus->type);
            })
            ->addColumn('created_at', function ($menus) {
                return Carbon::parse($menus->created_at)->toDateTimeString();
            })
            ->addColumn('updated_at', function ($menus) {
                return Carbon::parse($menus->updated_at)->toDateTimeString();
            })
            ->addColumn('actions', function ($menus) {
                return $menus->action_buttons;
            })
            ->make(true);
    }
}
