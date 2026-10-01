<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageDeleted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageId;
    public $roomId;

    public function __construct(int $messageId, int $roomId)
    {
        $this->messageId = $messageId;
        $this->roomId = $roomId;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->roomId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'MessageDeleted';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->messageId,
            'room_id' => $this->roomId,
        ];
    }
}
