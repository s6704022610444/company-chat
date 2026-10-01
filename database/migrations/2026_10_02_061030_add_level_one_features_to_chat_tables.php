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
        // Add chat_rooms columns safely
        if (!Schema::hasColumn('chat_rooms', 'is_direct')) {
            Schema::table('chat_rooms', function (Blueprint $table) {
                $table->boolean('is_direct')->default(false);
            });
        }

        if (!Schema::hasColumn('chat_rooms', 'user1_id')) {
            Schema::table('chat_rooms', function (Blueprint $table) {
                $table->unsignedBigInteger('user1_id')->nullable();
            });
            try {
                Schema::table('chat_rooms', function (Blueprint $table) {
                    $table->foreign('user1_id')->references('id')->on('users')->onDelete('cascade');
                });
            } catch (\Throwable $e) {
                // foreign key may already exist or DB driver ignored
            }
        }

        if (!Schema::hasColumn('chat_rooms', 'user2_id')) {
            Schema::table('chat_rooms', function (Blueprint $table) {
                $table->unsignedBigInteger('user2_id')->nullable();
            });
            try {
                Schema::table('chat_rooms', function (Blueprint $table) {
                    $table->foreign('user2_id')->references('id')->on('users')->onDelete('cascade');
                });
            } catch (\Throwable $e) {
                // foreign key may already exist or DB driver ignored
            }
        }

        // Add messages columns safely
        if (!Schema::hasColumn('messages', 'file_data')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->longText('file_data')->nullable();
            });
        }

        if (!Schema::hasColumn('messages', 'file_name')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->string('file_name')->nullable();
            });
        }

        if (!Schema::hasColumn('messages', 'file_size')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->integer('file_size')->nullable();
            });
        }

        if (!Schema::hasColumn('messages', 'file_type')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->string('file_type')->nullable();
            });
        }

        if (!Schema::hasColumn('messages', 'is_edited')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->boolean('is_edited')->default(false);
            });
        }

        if (!Schema::hasColumn('messages', 'is_deleted')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->boolean('is_deleted')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $messageCols = array_filter(['file_data', 'file_name', 'file_size', 'file_type', 'is_edited', 'is_deleted'], function($col) {
            return Schema::hasColumn('messages', $col);
        });
        if (!empty($messageCols)) {
            Schema::table('messages', function (Blueprint $table) use ($messageCols) {
                $table->dropColumn($messageCols);
            });
        }

        $roomCols = array_filter(['is_direct', 'user1_id', 'user2_id'], function($col) {
            return Schema::hasColumn('chat_rooms', $col);
        });
        if (!empty($roomCols)) {
            Schema::table('chat_rooms', function (Blueprint $table) use ($roomCols) {
                $table->dropColumn($roomCols);
            });
        }
    }
};
