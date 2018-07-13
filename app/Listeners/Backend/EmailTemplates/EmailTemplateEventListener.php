<?php

namespace App\Listeners\Backend\EmailTemplates;

/**
 * Class EmailTemplateEventListener.
 */
class EmailTemplateEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'EmailTemplate';

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->emailtemplates->id)
            ->withText('trans("history.backend.emailtemplates.updated") <strong>'.$event->emailtemplates->title.'</strong>')
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
            ->withEntity($event->emailtemplates->id)
            ->withText('trans("history.backend.emailtemplates.deleted") <strong>'.$event->emailtemplates->title.'</strong>')
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
            \App\Events\Backend\EmailTemplates\EmailTemplateUpdated::class,
            'App\Listeners\Backend\EmailTemplates\EmailTemplateEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\EmailTemplates\EmailTemplateDeleted::class,
            'App\Listeners\Backend\EmailTemplates\EmailTemplateEventListener@onDeleted'
        );
    }
}
