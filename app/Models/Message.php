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