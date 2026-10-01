<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            // คนสร้างงาน
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            // คนรับผิดชอบงาน
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            // สถานะงาน
            $table->string('status')
                ->default('ยังไม่เริ่ม');

            // ความสำคัญ
            $table->string('priority')
                ->default('ปกติ');

            // กำหนดส่ง
            $table->dateTime('due_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};