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
    protected $model;

    /**
     * BlogCategoriesRepository constructor.
     *
     * @param  Blog  $model
     */
    public function __construct(BlogCategory $model)
    {
        $this->model = $model;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        // dd($this->model->query());
        return $this->model->query()
            ->leftjoin('users', 'users.id', '=', 'blog_categories.created_by')
            ->select([
                'blog_categories.id',
                'blog_categories.name',
                'blog_categories.status',
                'blog_categories.created_by',
                'blog_categories.created_at',
                'users.first_name as user_name',
            ])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
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
        if ($this->model->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.access.blog-category.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['created_by'] = auth()->user()->id;

            if ($blogcategory = BlogCategory::create($input)) {
                event(new BlogCategoryCreated($blogcategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.blog-category.create_error'));
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
        if ($this->model->query()->where('name', $input['name'])->where('id', '!=', $blogcategory->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.access.blog-category.already_exists'));
        }

        DB::transaction(function () use ($blogcategory, $input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['updated_by'] = auth()->user()->id;

            if ($blogcategory->update($input)) {
                event(new BlogCategoryUpdated($blogcategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.blog-category.update_error'));
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

            throw new GeneralException(trans('exceptions.backend.access.blog-category.delete_error'));
        });
    }
}
