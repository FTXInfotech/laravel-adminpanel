<?php

namespace App\Repositories\Backend;

use App\Events\Backend\BlogTags\BlogTagCreated;
use App\Events\Backend\BlogTags\BlogTagDeleted;
use App\Events\Backend\BlogTags\BlogTagUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogTag;
use App\Repositories\BaseRepository;

class BlogTagsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogTag::class;

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
            ->leftjoin('users', 'users.id', '=', 'blog_tags.created_by')
            ->select([
                'blog_tags.id',
                'blog_tags.name',
                'blog_tags.status',
                'blog_tags.created_at',
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
            throw new GeneralException(__('exceptions.backend.blog-tag.already_exists'));
        }

        $input['status'] = $input['status'] ?? 0;
        $input['created_by'] = auth()->user()->id;

        if ($blogtag = BlogTag::create($input)) {
            event(new BlogTagCreated($blogtag));

            return $blogtag;
        }

        throw new GeneralException(__('exceptions.backend.blog-tag.create_error'));
    }

    /**
     * @param \App\Models\BlogTag $blogtag
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(BlogTag $blogtag, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogtag->id)->first()) {
            throw new GeneralException(__('exceptions.backend.blog-tag.already_exists'));
        }

        $input['status'] = $input['status'] ?? 0;
        $input['updated_by'] = auth()->user()->id;

        if ($blogtag->update($input)) {
            event(new BlogTagUpdated($blogtag));

            return $blogtag->fresh();
        }

        throw new GeneralException(__('exceptions.backend.blog-tag.update_error'));
    }

    /**
     * @param \App\Models\BlogTag $blogtag
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(BlogTag $blogtag)
    {
        if ($blogtag->delete()) {
            event(new BlogTagDeleted($blogtag));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.blog-tag.delete_error'));
    }
}
