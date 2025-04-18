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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('chat_id')->comment('ID чата на платформе');
            $table->timestamps();
        });

        Schema::create('bot_chat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bot_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chat_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_chat');
        Schema::dropIfExists('chats');
    }
};
