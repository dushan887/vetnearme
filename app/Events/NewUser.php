<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $_user;
    public $_tempPass;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $tempPass)
    {
        $this->_user     = $user;
        $this->_tempPass = $tempPass;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
