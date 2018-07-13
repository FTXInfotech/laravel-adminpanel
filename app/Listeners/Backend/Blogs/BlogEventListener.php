<?php

namespace App\Listeners\Backend\Blogs;

/**
 * Class BlogEventListener.
 */
class BlogEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Blog';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->blogs->id)
            ->withText('trans("history.backend.blogs.created") <strong>'.$event->blogs->name.'</strong>')
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
            ->withEntity($event->blogs->id)
            ->withText('trans("history.backend.blogs.updated") <strong>'.$event->blogs->name.'</strong>')
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
            ->withEntity($event->blogs->id)
            ->withText('trans("history.backend.blogs.deleted") <strong>'.$event->blogs->name.'</strong>')
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
            \App\Events\Backend\Blogs\BlogCreated::class,
            'App\Listeners\Backend\Blogs\BlogEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Blogs\BlogUpdated::class,
            'App\Listeners\Backend\Blogs\BlogEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Blogs\BlogDeleted::class,
            'App\Listeners\Backend\Blogs\BlogEventListener@onDeleted'
        );
    }
}
