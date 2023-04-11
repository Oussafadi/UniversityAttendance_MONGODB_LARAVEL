<?php

namespace App\Providers;

use App\Models\Teacher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeanceStartingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $teacher;
    public $seance;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $seance, Teacher $teacher)
    {
        $this->seance = $seance;
        $this->teacher = $teacher;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
