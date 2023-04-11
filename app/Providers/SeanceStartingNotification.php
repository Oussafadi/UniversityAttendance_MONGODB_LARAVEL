<?php

namespace App\Providers;

use App\Providers\SeanceStartingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StartSeanceNotification;


class SeanceStartingNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\SeanceStartingEvent  $event
     * @return void
     */
    public function handle(SeanceStartingEvent $event)
    {
        $students = $event->teacher->module->filiere->students;
        $users = [];
        foreach ($students as $student) {
            $users[] = $student->user;
        }
        Notification::send($users, new StartSeanceNotification($event->seance, $event->teacher));
    }
}
