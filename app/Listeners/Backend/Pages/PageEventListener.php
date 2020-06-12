<?php

namespace App\Listeners\Backend\Pages;

/**
 * Class PageEventListener.
 */
class PageEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Page';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->page->id)
            ->withText('trans("history.backend.pages.created") <strong>'.$event->page->title.'</strong>')
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
            ->withEntity($event->page->id)
            ->withText('trans("history.backend.pages.updated") <strong>'.$event->page->title.'</strong>')
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
            ->withEntity($event->page->id)
            ->withText('trans("history.backend.pages.deleted") <strong>'.$event->page->title.'</strong>')
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
            \App\Events\Backend\Pages\PageCreated::class,
            'App\Listeners\Backend\Pages\PageEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Pages\PageUpdated::class,
            'App\Listeners\Backend\Pages\PageEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Pages\PageDeleted::class,
            'App\Listeners\Backend\Pages\PageEventListener@onDeleted'
        );
    }
}
