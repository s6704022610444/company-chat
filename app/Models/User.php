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

    /**
     * Get the hex color corresponding to the user's position/role:
     * 1. พนักงาน: เขียวสด (#00C853)
     * 2. หัวหน้างาน: ฟ้าสว่าง (#00B0FF)
     * 3. ผู้บริหาร / ผู้จัดการ: เหลืองทองเข้ม (#FFB300)
     * 4. แอดมิน / ผู้ดูแลระบบ: แดงนีออน/สว่าง (#FF3D00)
     */
    public function getPositionColorAttribute(): string
    {
        $pos = mb_strtolower(trim($this->position ?? ''));
        if (str_contains($pos, 'แอดมิน') || str_contains($pos, 'ผู้ดูแลระบบ') || str_contains($pos, 'admin')) {
            return '#FF3D00';
        }
        if (str_contains($pos, 'ผู้บริหาร') || str_contains($pos, 'ผู้จัดการ') || str_contains($pos, 'manager') || str_contains($pos, 'executive')) {
            return '#FFB300';
        }
        if (str_contains($pos, 'หัวหน้างาน') || str_contains($pos, 'supervisor')) {
            return '#00B0FF';
        }
        return '#00C853';
    }

    /**
     * Check if user has permission to create, edit, or delete tasks.
     * Restricted strictly to ผู้บริหาร / ผู้จัดการ / ผู้ดูแลระบบ / แอดมิน.
     */
    public function canManageTasks(): bool
    {
        $pos = mb_strtolower(trim($this->position ?? ''));
        return str_contains($pos, 'แอดมิน') || 
               str_contains($pos, 'ผู้ดูแลระบบ') || 
               str_contains($pos, 'admin') || 
               str_contains($pos, 'ผู้บริหาร') || 
               str_contains($pos, 'ผู้จัดการ') || 
               str_contains($pos, 'executive') ||
               str_contains($pos, 'manager');
    }

    /**
     * Check if user has permission to create, edit, delete, or pin company news announcements.
     * Restricted strictly to ผู้บริหาร / ผู้จัดการ / ผู้ดูแลระบบ / แอดมิน.
     */
    public function canManageNews(): bool
    {
        $pos = mb_strtolower(trim($this->position ?? ''));
        return str_contains($pos, 'แอดมิน') || 
               str_contains($pos, 'ผู้ดูแลระบบ') || 
               str_contains($pos, 'admin') || 
               str_contains($pos, 'ผู้บริหาร') || 
               str_contains($pos, 'ผู้จัดการ') || 
               str_contains($pos, 'executive') ||
               str_contains($pos, 'manager');
    }

    public function news(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\News::class);
    }
}
