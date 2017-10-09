<?php

namespace App\Repositories\Backend\Menu;

use App\Exceptions\GeneralException;
use App\Models\Menu\Menu;
use App\Repositories\BaseRepository;
use DB;
//use App\Events\Backend\CMSPages\CMSPageCreated;
//use App\Events\Backend\CMSPages\CMSPageDeleted;
//use App\Events\Backend\CMSPages\CMSPageUpdated;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuRepository.
 */
class MenuRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Menu::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.menus_table').'.id',
                config('access.menus_table').'.name',
                config('access.menus_table').'.type',
                config('access.menus_table').'.created_at',
                config('access.menus_table').'.updated_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.menus.already_exists'));
        }

        $menu = self::MODEL;
        $menu = new $menu();
        $menu->name = $input['name'];
        $menu->type = $input['type'];
        $menu->items = $input['items'];
        $menu->created_by = access()->user()->id;
        DB::transaction(function () use ($input, $menu) {
            if ($menu->save()) {
                //event(new CMSPageCreated($menu));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.menus.create_error'));
        });
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
    public function update(Model $menu, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $menu->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.menus.already_exists'));
        }
        $menu->name = $input['name'];
        $menu->type = $input['type'];
        $menu->items = $input['items'];
        $menu->updated_by = access()->user()->id;

        DB::transaction(function () use ($menu, $input) {
            if ($menu->save()) {
                //event(new CMSPageUpdated($menu));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.menus.update_error'));
        });
    }

    /**
     * @param Model $cmspage
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $menu)
    {
        DB::transaction(function () use ($menu) {
            if ($menu->delete()) {
                //event(new CMSPageDeleted($menu));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.menus.delete_error'));
        });
    }
}
