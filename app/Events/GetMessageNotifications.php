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
    use Dispatchable, InteractsWithSockets;

    public $message;
    public function __construct($message)
    {
        $this->message = $message;
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
