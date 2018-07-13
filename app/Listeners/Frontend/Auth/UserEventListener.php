<?php

namespace App\Listeners\Frontend\Auth;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        \Log::info('User Logged In: '.$event->user->first_name);

        // Generating notification
        createNotification('User Logged In: '.$event->user->first_name, 1);
    }

    /**
     * @param $event
     */
    public function onLoggedOut($event)
    {
        \Log::info('User Logged Out: '.$event->user->first_name);
    }

    /**
     * @param $event
     */
    public function onRegistered($event)
    {
        \Log::info('User Registered: '.$event->user->full_name);
    }

    /**
     * @param $event
     */
    /*public function onRegistered($event)
    {
        \Log::info('User Registered: '.$event->user->first_name);

        // Send email to the user
        $options = [
                'data'                => $event->user,
                'email_template_type' => 1,
            ];
        createNotification('', 1, 2, $options);
    }*/

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('User Confirmed: '.$event->user->first_name);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Frontend\Auth\UserLoggedIn::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onLoggedIn'
        );

        $events->listen(
            \App\Events\Frontend\Auth\UserLoggedOut::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onLoggedOut'
        );

        $events->listen(
            \App\Events\Frontend\Auth\UserRegistered::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onRegistered'
        );

        $events->listen(
            \App\Events\Frontend\Auth\UserConfirmed::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onConfirmed'
        );
    }
}
