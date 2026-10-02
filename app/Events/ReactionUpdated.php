<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReactionUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageId;
    public $roomId;
    public $reactions;

    public function __construct(int $messageId, int $roomId, array $reactions)
    {
        $this->messageId = $messageId;
        $this->roomId = $roomId;
        $this->reactions = $reactions;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->roomId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ReactionUpdated';
    }

    public function broadcastWith(): array
    {
        return [
            'message_id' => $this->messageId,
            'room_id' => $this->roomId,
            'reactions' => $this->reactions,
        ];
    }
}
