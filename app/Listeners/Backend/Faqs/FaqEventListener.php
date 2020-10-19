<?php

namespace App\Listeners\Backend\Faqs;

/**
 * Class FaqEventListener.
 */
class FaqEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Faq';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->faq->id)
            ->withText('trans("history.backend.faqs.created") <strong>'.$event->page->title.'</strong>')
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
            ->withEntity($event->faq->id)
            ->withText('trans("history.backend.faqs.updated") <strong>'.$event->faq->question.'</strong>')
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
            ->withEntity($event->faq->id)
            ->withText('trans("history.backend.faqs.deleted") <strong>'.$event->faq->question.'</strong>')
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
            \App\Events\Backend\Faqs\FaqCreated::class,
            'App\Listeners\Backend\Faqs\FaqEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Faqs\FaqUpdated::class,
            'App\Listeners\Backend\Faqs\FaqEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Faqs\FaqDeleted::class,
            'App\Listeners\Backend\Faqs\FaqEventListener@onDeleted'
        );
    }
}
