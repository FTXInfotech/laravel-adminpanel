<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Notification\MarkNotificationRequest;
use App\Models\Notification\Notification;
use App\Repositories\Backend\Notification\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Notification\NotificationRepository
     */
    protected $notification;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    /*
     * Ajax data fetch function
     */
    public function ajaxNotifications()
    {
        /*
         * get user id
         */
        $userId = Auth::user()->id;
        /*
         * where conditions to get count
         */
        $where = ['user_id' => $userId, 'is_read' => 0];
        /*
         * get unread count
         */
        $getUnreadNotificationCount = $this->notification->getNotification($where, 'count');
        /*
         * where condition to list top notifications
         */
        $listWhere = ['user_id' => $userId, 'is_read' => 0];
        /*
         * get top 5 notifications
         */
        $getNotifications = $this->notification->getNotification($listWhere, 'get', $limit = 5);
        /*
         * preparing pass array which contain view and count both
         */
        $passArray['view'] = view('backend.includes.notification')
                ->with('notifications', $getNotifications)
                ->with('unreadNotificationCount', $getUnreadNotificationCount)
                ->render();
        $passArray['count'] = $getUnreadNotificationCount;
        /*
         * pass jsonencode array
         */
        echo json_encode($passArray);
        die;
    }

    /*
     * clearCurrentNotifications
     */
    public function clearCurrentNotifications()
    {
        $userId = Auth::user()->id;
        echo $this->notification->clearNotifications(5);
        die;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', access()->user()->id)->get();

        return view('backend.notification.index', compact('notifications'));
    }

    /**
     * @param type                    $id
     * @param type                    $status
     * @param MarkNotificationRequest $request
     *
     * @return type
     */
    public function mark($id, $status, MarkNotificationRequest $request)
    {
        $this->notification->mark($id, $status);

        return response()->json(['status' => 'OK']);
    }
}
