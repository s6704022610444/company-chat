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
                'name' => 'Admin ผู้ดูแลระบบ',
                'password' => Hash::make('12345678'),
                'position' => 'ผู้ดูแลระบบ',
            ]
        );

        $manager = User::firstOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name' => 'สมชาย ผู้จัดการ',
                'password' => Hash::make('12345678'),
                'position' => 'ผู้จัดการ',
            ]
        );

        $supervisor = User::firstOrCreate(
            ['email' => 'supervisor@gmail.com'],
            [
                'name' => 'สมศรี หัวหน้างาน',
                'password' => Hash::make('12345678'),
                'position' => 'หัวหน้างาน',
            ]
        );

        $staff1 = User::firstOrCreate(
            ['email' => 'test02@gmail.com'],
            [
                'name' => 'กิตติ พนักงาน (test02)',
                'password' => Hash::make('12345678'),
                'position' => 'พนักงาน',
            ]
        );

        $staff2 = User::firstOrCreate(
            ['email' => 'test03@gmail.com'],
            [
                'name' => 'วิภา พนักงาน (test03)',
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
                'description' => 'ห้องทดสอบ 01 สำหรับงานโปรเจกต์',
                'created_by' => $admin->id,
            ]
        );

        ChatRoom::firstOrCreate(
            ['name' => 'Test02'],
            [
                'description' => 'ห้องทดสอบ 02 ประสานงานด่วน',
                'created_by' => $admin->id,
            ]
        );

        // Seed Sample Tasks
        $task1 = \App\Models\Task::firstOrCreate(
            ['title' => 'เตรียมเอกสารสรุปยอดขายประจำไตรมาส'],
            [
                'description' => 'รวบรวมไฟล์ Excel ยอดขายทุกสาขาเพื่อนำเสนอในที่ประชุม',
                'created_by' => $manager->id,
                'assigned_to' => $staff1->id,
                'status' => 'กำลังดำเนินการ',
                'priority' => 'ด่วน',
                'due_at' => now()->addHours(3),
            ]
        );

        if ($task1->histories()->count() === 0) {
            \App\Models\TaskHistory::create([
                'task_id' => $task1->id,
                'user_id' => $staff1->id,
                'old_status' => 'ยังไม่เริ่ม',
                'new_status' => 'รับงานแล้ว',
            ]);
            \App\Models\TaskHistory::create([
                'task_id' => $task1->id,
                'user_id' => $staff1->id,
                'old_status' => 'รับงานแล้ว',
                'new_status' => 'กำลังดำเนินการ',
            ]);
        }

        \App\Models\Task::firstOrCreate(
            ['title' => 'ตรวจสอบระบบความปลอดภัยประจำสัปดาห์'],
            [
                'description' => 'ตรวจสอบสิทธิ์การเข้าถึงฐานข้อมูลและบันทึก Log ของระบบ',
                'created_by' => $admin->id,
                'assigned_to' => $supervisor->id,
                'status' => 'ยังไม่เริ่ม',
                'priority' => 'สูง',
                'due_at' => now()->addDay(),
            ]
        );

        \App\Models\Task::firstOrCreate(
            ['title' => 'ส่งรายงานสรุปผลการปฏิบัติงานรายวัน'],
            [
                'description' => 'สรุปงานประจำวันที่ได้ดำเนินการส่งผ่านระบบ',
                'created_by' => $supervisor->id,
                'assigned_to' => $staff1->id,
                'status' => 'เสร็จแล้ว',
                'priority' => 'ปกติ',
                'due_at' => now()->subDay(),
            ]
        );
    }
}
