<?php

namespace App\Repositories\Backend\Notification;

use App\Exceptions\GeneralException;
use App\Models\Notification\Notification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class NotificationRepository.
 */
class NotificationRepository extends BaseRepository
{
    /**
     * related model of this repositery.
     *
     * @var object
     */
    public $model;
    public $timestamps = false;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    /**
     * [create description].
     *
     * @param [type] $result [description]
     *
     * @return [type] [description]
     */
    public function create($message, $userId, $type = 'success', $createdBy = null)
    {
        $this->model->message = $message;
        $this->model->user_id = $userId;
        $this->model->type = $type;
        if ($createdBy) {
            $this->model->created_by = $createdBy;
        } else {
            $this->model->created_by = Auth::user()->id;
        }
        if ($this->model->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param  $id
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($id, $request)
    {
        $notification = $this->findOrThrowException($id);
        $input = $request->all();
        $notification->name = $input['name'];
        $notification->status = $input['status'];
        $notification->updated_by = $request->user()->id;

        // dd($input);
        if ($notification->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.notification.update_error'));
    }

    /**
     * @param  $id
     * @param  $is_active
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark($id, $status)
    {
        $notification = $this->findOrThrowException($id);
        $notification->is_read = $status;
        if ($notification->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.notification.mark_error'));
    }

    /**
     * [display description].
     *
     * @param [type] $result [description]
     *
     * @return [type] [description]
     */
    public function getNotification($where, $type = 'count', $limit = null)
    {
        $query = $this->model;

        foreach ($where as $k => $v) {
            $query = $query->where($k, '=', $v);
        }
        if ($limit) {
            $query = $query->take($limit);
        }
        $query = $query->where('user_id', auth()->user()->id);
//        $query = $query->orderBy('is_read', 'desc');
        $query = $query->orderBy('created_at', 'desc');
        $count = $query->$type();

        return $count;
    }

    /**
     * [clear description].
     *
     * @param [type] $result [description]
     *
     * @return [type] [null]
     */
    public function clearNotifications($limit = 'all')
    {
        $query = $this->model;
        if ($limit != 'all') {
            $query->where('is_read', '=', 0);
            $query = $query->orderBy('is_read', 'asc');
            $query = $query->orderBy('created_at', 'desc');
            $query = $query->limit($limit);
        }

        $query->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');

        if ($query->update(['is_read' => 1])) {
            return true;
        } else {
            return false;
        }
    }
}
