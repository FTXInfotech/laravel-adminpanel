<?php

namespace App\Listeners\Backend\CMSPages;

/**
 * Class CMSPageEventListener.
 */
class CMSPageEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'CMSPage';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->cmspages->id)
            ->withText('trans("history.backend.cmspages.created") <strong>'.$event->cmspages->title.'</strong>')
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
            ->withEntity($event->cmspages->id)
            ->withText('trans("history.backend.cmspages.updated") <strong>'.$event->cmspages->title.'</strong>')
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
            ->withEntity($event->cmspages->id)
            ->withText('trans("history.backend.cmspages.deleted") <strong>'.$event->cmspages->title.'</strong>')
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
            \App\Events\Backend\CMSPages\CMSPageCreated::class,
            'App\Listeners\Backend\CMSPages\CMSPageEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\CMSPages\CMSPageUpdated::class,
            'App\Listeners\Backend\CMSPages\CMSPageEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\CMSPages\CMSPageDeleted::class,
            'App\Listeners\Backend\CMSPages\CMSPageEventListener@onDeleted'
        );
    }
}
