<?php

namespace App\Listeners\Backend\BlogCategories;

/**
 * Class BlogCategoryEventListener.
 */
class BlogCategoryEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'BlogCategory';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->blogcategory->id)
            ->withText('trans("history.backend.blogcategories.created") <strong>'.$event->blogcategory->name.'</strong>')
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
            ->withEntity($event->blogcategory->id)
            ->withText('trans("history.backend.blogcategories.updated") <strong>'.$event->blogcategory->name.'</strong>')
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
            ->withEntity($event->blogcategory->id)
            ->withText('trans("history.backend.blogcategories.deleted") <strong>'.$event->blogcategory->name.'</strong>')
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
            \App\Events\Backend\BlogCategories\BlogCategoryCreated::class,
            'App\Listeners\Backend\BlogCategories\BlogCategoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\BlogCategories\BlogCategoryUpdated::class,
            'App\Listeners\Backend\BlogCategories\BlogCategoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\BlogCategories\BlogCategoryDeleted::class,
            'App\Listeners\Backend\BlogCategories\BlogCategoryEventListener@onDeleted'
        );
    }
}
