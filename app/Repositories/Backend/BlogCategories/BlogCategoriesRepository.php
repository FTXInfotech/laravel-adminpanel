<?php

namespace App\Repositories\Backend\BlogCategories;

use App\Events\Backend\BlogCategories\BlogCategoryCreated;
use App\Events\Backend\BlogCategories\BlogCategoryDeleted;
use App\Events\Backend\BlogCategories\BlogCategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogCategories\BlogCategory;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategoriesRepository.
 */
class BlogCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogCategory::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('access.blog_categories_table').'.created_by')
            ->select([
                config('access.blog_categories_table').'.id',
                config('access.blog_categories_table').'.name',
                config('access.blog_categories_table').'.status',
                config('access.blog_categories_table').'.created_by',
                config('access.blog_categories_table').'.created_at',
                config('access.users_table').'.first_name as user_name',
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
            throw new GeneralException(trans('exceptions.backend.blogcategories.already_exists'));
        }
        DB::transaction(function () use ($input) {
            $blogcategories = self::MODEL;
            $blogcategories = new $blogcategories();
            $blogcategories->name = $input['name'];
            $blogcategories->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;
            $blogcategories->created_by = access()->user()->id;

            if ($blogcategories->save()) {
                event(new BlogCategoryCreated($blogcategories));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogcategories.create_error'));
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
    public function update(Model $blogcategories, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogcategories->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.blogcategories.already_exists'));
        }
        $blogcategories->name = $input['name'];
        $blogcategories->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;
        $blogcategories->updated_by = access()->user()->id;

        DB::transaction(function () use ($blogcategories, $input) {
            if ($blogcategories->save()) {
                event(new BlogCategoryUpdated($blogcategories));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.blogcategories.update_error')
            );
        });
    }

    /**
     * @param Model $blogcategory
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $blogcategory)
    {
        DB::transaction(function () use ($blogcategory) {
            if ($blogcategory->delete()) {
                event(new BlogCategoryDeleted($blogcategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogcategories.delete_error'));
        });
    }
}
