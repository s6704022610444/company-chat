<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message->load('user');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->message->room_id),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message ?? '',
            'image' => $this->message->image,
            'audio' => $this->message->audio,
            'audio_duration' => $this->message->audio_duration,
            'room_id' => $this->message->room_id,
            'user_id' => $this->message->user_id,
            'user_name' => $this->message->user ? $this->message->user->name : 'User',
            'user_first_name' => $this->message->user ? $this->message->user->resolved_first_name : 'User',
            'user_position' => $this->message->user ? ($this->message->user->position ?: 'พนักงาน') : 'พนักงาน',
            'user_display_name' => $this->message->user ? $this->message->user->chat_display_name : 'User',
            'user_avatar' => $this->message->user ? $this->message->user->avatar : null,
            'created_at' => $this->message->created_at ? $this->message->created_at->format('H:i') : '',
        ];
    }
}
