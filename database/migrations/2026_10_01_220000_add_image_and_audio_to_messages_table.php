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
        Schema::table('messages', function (Blueprint $table) {
            $table->text('message')->nullable()->change();
            $table->longText('image')->nullable()->after('message');
            $table->longText('audio')->nullable()->after('image');
            $table->integer('audio_duration')->nullable()->after('audio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['image', 'audio', 'audio_duration']);
        });
    }
};
