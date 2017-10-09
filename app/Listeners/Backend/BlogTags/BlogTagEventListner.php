<?php

namespace App\Listeners\Backend\BlogTags;

/**
 * Class BlogTagEventListener.
 */
class BlogTagEventListner
{
    /**
     * @var string
     */
    private $history_slug = 'BlogTag';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->blogtags->id)
            ->withText('trans("history.backend.blogtags.created") <strong>'.$event->blogtags->name.'</strong>')
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
            ->withEntity($event->blogtags->id)
            ->withText('trans("history.backend.blogtags.updated") <strong>'.$event->blogtags->name.'</strong>')
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
            ->withEntity($event->blogtags->id)
            ->withText('trans("history.backend.blogtags.deleted") <strong>'.$event->blogtags->name.'</strong>')
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
            \App\Events\Backend\BlogTags\BlogTagCreated::class,
            'App\Listeners\Backend\BlogTags\BlogTagEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\BlogTags\BlogTagUpdated::class,
            'App\Listeners\Backend\BlogTags\BlogTagEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\BlogTags\BlogTagDeleted::class,
            'App\Listeners\Backend\BlogTags\BlogTagEventListener@onDeleted'
        );
    }
}
