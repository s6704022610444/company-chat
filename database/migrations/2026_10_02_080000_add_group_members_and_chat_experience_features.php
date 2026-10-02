<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add is_private column to chat_rooms
        if (!Schema::hasColumn('chat_rooms', 'is_private')) {
            Schema::table('chat_rooms', function (Blueprint $table) {
                $table->boolean('is_private')->default(false);
            });
        }

        // 2. Create chat_room_users pivot table
        if (!Schema::hasTable('chat_room_users')) {
            Schema::create('chat_room_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('chat_room_id')->constrained('chat_rooms')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('role')->default('member'); // 'admin', 'member'
                $table->timestamps();

                $table->unique(['chat_room_id', 'user_id']);
            });
        }

        // 3. Add reply_to_id to messages
        if (!Schema::hasColumn('messages', 'reply_to_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->unsignedBigInteger('reply_to_id')->nullable()->after('room_id');
            });
            try {
                Schema::table('messages', function (Blueprint $table) {
                    $table->foreign('reply_to_id')->references('id')->on('messages')->nullOnDelete();
                });
            } catch (\Throwable $e) {
                // foreign key may fail if SQLite or unsupported driver
            }
        }

        // 4. Create message_reactions table
        if (!Schema::hasTable('message_reactions')) {
            Schema::create('message_reactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('message_id')->constrained('messages')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('emoji', 32);
                $table->timestamps();

                $table->unique(['message_id', 'user_id', 'emoji']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_reactions');

        if (Schema::hasColumn('messages', 'reply_to_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->dropColumn('reply_to_id');
            });
        }

        Schema::dropIfExists('chat_room_users');

        if (Schema::hasColumn('chat_rooms', 'is_private')) {
            Schema::table('chat_rooms', function (Blueprint $table) {
                $table->dropColumn('is_private');
            });
        }
    }
};
