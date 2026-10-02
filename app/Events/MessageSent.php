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
        $this->message = $message->load(['user', 'replyTo.user', 'reactions.user']);
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
            'file_data' => $this->message->file_data,
            'file_name' => $this->message->file_name,
            'file_size' => $this->message->file_size,
            'file_formatted_size' => $this->message->formatted_file_size,
            'file_type' => $this->message->file_type,
            'is_edited' => (bool)$this->message->is_edited,
            'is_deleted' => (bool)$this->message->is_deleted,
            'room_id' => $this->message->room_id,
            'user_id' => $this->message->user_id,
            'user_name' => $this->message->user ? $this->message->user->name : 'User',
            'user_first_name' => $this->message->user ? $this->message->user->resolved_first_name : 'User',
            'user_position' => $this->message->user ? ($this->message->user->position ?: 'พนักงาน') : 'พนักงาน',
            'user_position_color' => $this->message->user ? $this->message->user->position_color : '#00C853',
            'user_display_name' => $this->message->user ? $this->message->user->chat_display_name : 'User',
            'user_avatar' => $this->message->user ? $this->message->user->avatar : null,
            'created_at' => $this->message->created_at ? $this->message->created_at->format('H:i') : '',
            'reply_to' => $this->message->replyTo ? [
                'id' => $this->message->replyTo->id,
                'user_name' => $this->message->replyTo->user?->name ?? 'User',
                'user_first_name' => $this->message->replyTo->user?->resolved_first_name ?? 'User',
                'message' => mb_substr($this->message->replyTo->message ?? '', 0, 100),
                'has_image' => !empty($this->message->replyTo->image),
                'has_file' => !empty($this->message->replyTo->file_data),
                'has_audio' => !empty($this->message->replyTo->audio),
            ] : null,
            'reactions' => $this->message->getGroupedReactions(),
        ];
    }
}
