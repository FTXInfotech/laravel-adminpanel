<?php

namespace App\Repositories\Backend\BlogCategories;

use App\Events\Backend\BlogCategories\BlogCategoryCreated;
use App\Events\Backend\BlogCategories\BlogCategoryDeleted;
use App\Events\Backend\BlogCategories\BlogCategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogCategories\BlogCategory;
use App\Repositories\BaseRepository;
use DB;

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
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.blog_categories.table').'.created_by')
            ->select([
                config('module.blog_categories.table').'.id',
                config('module.blog_categories.table').'.name',
                config('module.blog_categories.table').'.status',
                config('module.blog_categories.table').'.created_by',
                config('module.blog_categories.table').'.created_at',
                config('access.users_table').'.first_name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.blogcategories.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['created_by'] = access()->user()->id;

            if ($blogcategory = BlogCategory::create($input)) {
                event(new BlogCategoryCreated($blogcategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogcategories.create_error'));
        });
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory $blogcategory
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(BlogCategory $blogcategory, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogcategory->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.blogcategories.already_exists'));
        }

        DB::transaction(function () use ($blogcategory, $input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['updated_by'] = access()->user()->id;

            if ($blogcategory->update($input)) {
                event(new BlogCategoryUpdated($blogcategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogcategories.update_error'));
        });
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory $blogcategory
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(BlogCategory $blogcategory)
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
