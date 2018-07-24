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
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.blog_tags.table').'.created_by')
            ->select([
                config('module.blog_tags.table').'.id',
                config('module.blog_tags.table').'.name',
                config('module.blog_tags.table').'.status',
                config('module.blog_tags.table').'.created_by',
                config('module.blog_tags.table').'.created_at',
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
            throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['created_by'] = access()->user()->id;

            if ($blogtag = BlogTag::create($input)) {
                event(new BlogTagCreated($blogtag));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogtags.create_error'));
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
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogtag->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
        }

        DB::transaction(function () use ($blogtag, $input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['updated_by'] = access()->user()->id;

            if ($blogtag->update($input)) {
                event(new BlogTagUpdated($blogtag));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.blogtags.update_error')
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

            throw new GeneralException(trans('exceptions.backend.blogtags.delete_error'));
        });
    }
}
