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
        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->boolean('is_direct')->default(false)->after('description');
            $table->foreignId('user1_id')->nullable()->after('is_direct')->constrained('users')->onDelete('cascade');
            $table->foreignId('user2_id')->nullable()->after('user1_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->longText('file_data')->nullable()->after('audio_duration');
            $table->string('file_name')->nullable()->after('file_data');
            $table->integer('file_size')->nullable()->after('file_name');
            $table->string('file_type')->nullable()->after('file_size');
            $table->boolean('is_edited')->default(false)->after('file_type');
            $table->boolean('is_deleted')->default(false)->after('is_edited');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['file_data', 'file_name', 'file_size', 'file_type', 'is_edited', 'is_deleted']);
        });

        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->dropForeign(['user1_id']);
            $table->dropForeign(['user2_id']);
            $table->dropColumn(['is_direct', 'user1_id', 'user2_id']);
        });
    }
};
