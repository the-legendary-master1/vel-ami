<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GetUnreadNotifications implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $unread;
    public $user;
    public function __construct($unread, $user)
    {
        $this->unread = $unread;
        $this->user = $user;
    }

    public function broadcastOn()
    {
      return ['get-unread-notifications'];
    }

    public function broadcastAs()
    {
      return 'get-unread-notifications';
    }
}
