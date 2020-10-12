<?php

namespace App\Repositories\Backend;

use App\Models\BlogCategory;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\BlogCategories\BlogCategoryCreated;
use App\Events\Backend\BlogCategories\BlogCategoryDeleted;
use App\Events\Backend\BlogCategories\BlogCategoryUpdated;

class BlogCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogCategory::class;

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->query()
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
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'blog_categories.created_by')
            ->select([
                'blog_categories.id',
                'blog_categories.name',
                'blog_categories.status',
                'blog_categories.created_at',
                'users.first_name as created_by',
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
            throw new GeneralException(__('exceptions.backend.blog-category.already_exists'));
        }

        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['created_by'] = auth()->user()->id;

        if ($blogcategory = BlogCategory::create($input)) {
            event(new BlogCategoryCreated($blogcategory));

            return $blogcategory;
        }

        throw new GeneralException(__('exceptions.backend.blog-category.create_error'));
    }

    /**
     * @param \App\Models\BlogCategory $blogcategory
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(BlogCategory $blogcategory, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogcategory->id)->first()) {
            throw new GeneralException(__('exceptions.backend.blog-category.already_exists'));
        }

        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['updated_by'] = auth()->user()->id;

        if ($blogcategory->update($input)) {
            event(new BlogCategoryUpdated($blogcategory));

            return $blogcategory;
        }

        throw new GeneralException(__('exceptions.backend.blog-category.update_error'));
    }

    /**
     * @param \App\Models\BlogCategory $blogcategory
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(BlogCategory $blogcategory)
    {
        if ($blogcategory->delete()) {
            event(new BlogCategoryDeleted($blogcategory));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.blog-category.delete_error'));
    }
}
