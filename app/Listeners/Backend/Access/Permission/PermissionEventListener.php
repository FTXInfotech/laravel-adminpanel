<?php

namespace App\Listeners\Backend\Access\Permission;

/**
 * Class PermissionEventListener.
 */
class PermissionEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Permission';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.created") <strong>'.$event->permission->name.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.updated") <strong>'.$event->permission->name.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.deleted") <strong>'.$event->permission->name.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Access\Permission\PermissionCreated::class,
            'App\Listeners\Backend\Access\Permission\PermissionEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Access\Permission\PermissionUpdated::class,
            'App\Listeners\Backend\Access\Permission\PermissionEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Access\Permission\PermissionDeleted::class,
            'App\Listeners\Backend\Access\Permission\PermissionEventListener@onDeleted'
        );
    }
}
