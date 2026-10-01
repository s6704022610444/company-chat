<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'first_name', 'last_name', 'email', 'password', 'position', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's first name, falling back to first part of full name.
     */
    public function getResolvedFirstNameAttribute(): string
    {
        if (!empty($this->first_name)) {
            return $this->first_name;
        }

        $parts = explode(' ', trim($this->name ?: 'User'));
        return $parts[0] ?: 'User';
    }

    /**
     * Get the chat display name: "ชื่อจริง (ตำแหน่ง)" e.g. "รัฐกรณ์ (ผู้ดูแลระบบ)"
     */
    public function getChatDisplayNameAttribute(): string
    {
        $firstName = $this->resolved_first_name;
        $position = $this->position ?: 'พนักงาน';
        return "{$firstName} ({$position})";
    }
}
