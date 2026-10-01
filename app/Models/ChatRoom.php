<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatRoom extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'is_direct',
        'user1_id',
        'user2_id',
    ];

    protected $casts = [
        'is_direct' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function user1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'room_id');
    }

    /**
     * Get the other user in a direct message room
     */
    public function getOtherUser(int $currentUserId): ?User
    {
        if (!$this->is_direct) return null;
        return $this->user1_id === $currentUserId ? $this->user2 : $this->user1;
    }

    /**
     * Get or create a 1-on-1 direct message room between two users
     */
    public static function getOrCreateDirectRoom(int $userAId, int $userBId): self
    {
        $u1 = min($userAId, $userBId);
        $u2 = max($userAId, $userBId);

        $room = self::where('is_direct', true)
            ->where(function ($q) use ($u1, $u2) {
                $q->where(function ($sq) use ($u1, $u2) {
                    $sq->where('user1_id', $u1)->where('user2_id', $u2);
                })->orWhere(function ($sq) use ($u1, $u2) {
                    $sq->where('user1_id', $u2)->where('user2_id', $u1);
                });
            })
            ->first();

        if ($room) {
            return $room;
        }

        $userA = User::find($u1);
        $userB = User::find($u2);
        $name = ($userA && $userB) ? "DM: {$userA->name} & {$userB->name}" : "Direct Chat";

        return self::create([
            'name' => $name,
            'description' => 'แชตส่วนตัว 1-ต่อ-1',
            'created_by' => $userAId,
            'is_direct' => true,
            'user1_id' => $u1,
            'user2_id' => $u2,
        ]);
    }
}