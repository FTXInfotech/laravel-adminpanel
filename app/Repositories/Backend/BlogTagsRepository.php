<?php

namespace App\Repositories\Backend;

use App\Models\BlogTag;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\BlogTags\BlogTagCreated;
use App\Events\Backend\BlogTags\BlogTagDeleted;
use App\Events\Backend\BlogTags\BlogTagUpdated;

class BlogTagsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogTag::class;

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
            ->leftjoin('users', 'users.id', '=', 'blog_tags.created_by')
            ->select([
                'blog_tags.id',
                'blog_tags.name',
                'blog_tags.status',
                'blog_tags.created_by',
                'blog_tags.created_at',
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

        $input['status'] = isset($input['status']) ? 1 : 0;
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

        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['updated_by'] = auth()->user()->id;

        if ($blogtag->update($input)) {
            event(new BlogTagUpdated($blogtag));

            return $blogtag;
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
