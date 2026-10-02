<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'message',
        'image',
        'audio',
        'audio_duration',
        'file_data',
        'file_name',
        'file_size',
        'file_type',
        'is_edited',
        'is_deleted',
        'reply_to_id',
    ];

    protected $casts = [
        'is_edited' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class, 'room_id');
    }

    public function replyTo(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'reply_to_id')->with('user');
    }

    public function reactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MessageReaction::class, 'message_id')->with('user');
    }

    /**
     * Group reactions by emoji with counts, user list, and has_me indicator
     */
    public function getGroupedReactions(?int $currentUserId = null): array
    {
        $grouped = [];
        foreach ($this->reactions as $rx) {
            $e = $rx->emoji;
            if (!isset($grouped[$e])) {
                $grouped[$e] = [
                    'emoji' => $e,
                    'count' => 0,
                    'has_me' => false,
                    'users' => [],
                ];
            }
            $grouped[$e]['count']++;
            $grouped[$e]['users'][] = $rx->user?->name ?? 'User';
            if ($currentUserId && $rx->user_id === $currentUserId) {
                $grouped[$e]['has_me'] = true;
            }
        }
        return array_values($grouped);
    }

    /**
     * Helper to format file size in KB / MB
     */
    public function getFormattedFileSizeAttribute(): ?string
    {
        if (!$this->file_size) return null;
        if ($this->file_size < 1024) return $this->file_size . ' B';
        if ($this->file_size < 1048576) return round($this->file_size / 1024, 1) . ' KB';
        return round($this->file_size / 1048576, 1) . ' MB';
    }
}