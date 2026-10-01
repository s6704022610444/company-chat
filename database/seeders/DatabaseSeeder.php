<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for production use.
     */
    public function run(): void
    {
        // 1. Create or ensure Primary Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin ผู้ดูแลระบบ',
                'password' => Hash::make('Admin@123456'),
                'position' => 'ผู้ดูแลระบบ',
            ]
        );

        if ($admin->position !== 'ผู้ดูแลระบบ') {
            $admin->position = 'ผู้ดูแลระบบ';
            $admin->save();
        }

        // 2. Create or ensure Default General Chat Room
        $generalRoom = ChatRoom::firstOrCreate(
            ['name' => 'ห้องทั่วไป (General)'],
            [
                'description' => 'ห้องสนทนากลางของบริษัท สำหรับพนักงานทุกคน',
                'created_by' => $admin->id,
            ]
        );

        // 3. Clean up old test data from database
        // Delete test rooms and their associated messages
        $testRooms = ChatRoom::whereIn('name', ['Test01', 'Test02'])->get();
        foreach ($testRooms as $room) {
            $room->messages()->delete();
            $room->delete();
        }

        // Clean up test tasks and history
        TaskHistory::query()->delete();
        Task::query()->delete();

        // Clean up old mock user accounts
        $testEmails = [
            'test@gmail.com',
            'manager@gmail.com',
            'supervisor@gmail.com',
            'test02@gmail.com',
            'test03@gmail.com',
        ];

        $testUserIds = User::whereIn('email', $testEmails)->pluck('id');
        if ($testUserIds->isNotEmpty()) {
            Message::whereIn('user_id', $testUserIds)->delete();
            User::whereIn('id', $testUserIds)->delete();
        }
    }
}
