<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GetMessageNotifications implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    public function broadcastOn()
    {
      return ['get-message-notifications'];
    }

    public function broadcastAs()
    {
      return 'get-message-notifications';
    }
}
