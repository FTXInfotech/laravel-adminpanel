<?php

namespace App\Repositories\Backend;

use App\Events\Backend\BlogCategories\BlogCategoryCreated;
use App\Events\Backend\BlogCategories\BlogCategoryDeleted;
use App\Events\Backend\BlogCategories\BlogCategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogCategory;
use App\Repositories\BaseRepository;

class BlogCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogCategory::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'creator',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
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

        $input['status'] = $input['status'] ?? 0;
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

        $input['status'] = $input['status'] ?? 0;
        $input['updated_by'] = auth()->user()->id;

        if ($blogcategory->update($input)) {
            event(new BlogCategoryUpdated($blogcategory));

            return $blogcategory->fresh();
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
