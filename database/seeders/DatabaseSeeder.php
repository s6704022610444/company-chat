<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('12345678'),
                'position' => 'ผู้ดูแลระบบ',
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'test02@gmail.com'],
            [
                'name' => 'test02',
                'password' => Hash::make('12345678'),
                'position' => 'พนักงาน',
            ]
        );

        $user3 = User::firstOrCreate(
            ['email' => 'test03@gmail.com'],
            [
                'name' => 'test03',
                'password' => Hash::make('12345678'),
                'position' => 'พนักงาน',
            ]
        );

        ChatRoom::firstOrCreate(
            ['name' => 'ห้องทั่วไป (General)'],
            [
                'description' => 'ห้องสนทนากลางของบริษัท',
                'created_by' => $admin->id,
            ]
        );

        ChatRoom::firstOrCreate(
            ['name' => 'Test01'],
            [
                'description' => 'ห้องทดสอบ 01',
                'created_by' => $admin->id,
            ]
        );

        ChatRoom::firstOrCreate(
            ['name' => 'Test02'],
            [
                'description' => 'ห้องทดสอบ 02',
                'created_by' => $admin->id,
            ]
        );
    }
}
