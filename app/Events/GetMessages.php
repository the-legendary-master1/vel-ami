<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GetMessages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $chat;
    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
      return ['get-messages'];
    }

    public function broadcastAs()
    {
      return 'get-messages';
    }
}
