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
        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->string('platform')->comment('Площадка для боота (Тг.Вк)');
            $table->float('version')->comment('Версия callback-api')->nullable();
            $table->string('url_handler')->comment('URL который будет назначен на бота после создание бота для вставки')->nullable();
            $table->bigInteger('id_chat')->nullable()->comment('Идентификатор чата');
            $table->string('token')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bots');
    }
};
