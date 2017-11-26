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
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('access.blog_tags_table').'.created_by')
            ->select([
                config('access.blog_tags_table').'.id',
                config('access.blog_tags_table').'.name',
                config('access.blog_tags_table').'.status',
                config('access.blog_tags_table').'.created_by',
                config('access.blog_tags_table').'.created_at',
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
            throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
        }
        DB::transaction(function () use ($input) {
            $blogtags = self::MODEL;
            $blogtags = new $blogtags();
            $blogtags->name = $input['name'];
            $blogtags->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;
            $blogtags->created_by = access()->user()->id;

            if ($blogtags->save()) {
                event(new BlogTagCreated($blogtags));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogtags.create_error'));
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
    public function update(Model $blogtags, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogtags->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
        }

        $blogtags->name = $input['name'];
        $blogtags->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;
        $blogtags->updated_by = access()->user()->id;

        DB::transaction(function () use ($blogtags, $input) {
            if ($blogtags->save()) {
                event(new BlogTagUpdated($blogtags));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.blogtags.update_error')
            );
        });
    }

    /**
     * @param Model $blogtag
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $blogtag)
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
