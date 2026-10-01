<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
        'cover_image',
        'audio_file',
        'audio_duration',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(NewsLike::class);
    }

    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'ประกาศสำคัญ', 'ข่าวด่วน' => '#FF3D00',
            'กิจกรรม' => '#00B0FF',
            'สวัสดิการ' => '#FFB300',
            default => '#00C853',
        };
    }
}
