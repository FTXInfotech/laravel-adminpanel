<?php

namespace App\Repositories\Backend\BlogTags;

use App\Events\Backend\BlogTags\BlogTagCreated;
use App\Events\Backend\BlogTags\BlogTagDeleted;
use App\Events\Backend\BlogTags\BlogTagUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogTags\BlogTag;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class BlogTagsRepository.
 */
class BlogTagsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogTag::class;

    /**
     * Associated Repository Model.
     */
    protected $model;

    /**
     * BlogTagsRepository constructor.
     *
     * @param  Blog  $model
     */
    public function __construct(BlogTag $model)
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
        return $this->model->query()
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
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->model->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.access.blog-tag.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['created_by'] = auth()->user()->id;

            if ($blogtag = BlogTag::create($input)) {
                event(new BlogTagCreated($blogtag));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.blog-tag.create_error'));
        });
    }

    /**
     * @param \App\Models\BlogTags\BlogTag $blogtag
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(BlogTag $blogtag, array $input)
    {
        if ($this->model->query()->where('name', $input['name'])->where('id', '!=', $blogtag->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.access.blog-tag.already_exists'));
        }

        DB::transaction(function () use ($blogtag, $input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['updated_by'] = auth()->user()->id;

            if ($blogtag->update($input)) {
                event(new BlogTagUpdated($blogtag));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.access.blog-tag.update_error')
            );
        });
    }

    /**
     * @param \App\Models\BlogTags\BlogTag $blogtag
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(BlogTag $blogtag)
    {
        DB::transaction(function () use ($blogtag) {
            if ($blogtag->delete()) {
                event(new BlogTagDeleted($blogtag));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.blog-tag.delete_error'));
        });
    }
}
