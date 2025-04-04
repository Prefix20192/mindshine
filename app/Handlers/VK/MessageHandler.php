<?php

namespace App\Handlers\VK;
use App\Models\Bot;
use DigitalStar\vk_api\vk_api as VK;

class MessageHandler
{
    public object $data;
    private VK $vk;
    private Bot $bot;

    public function __construct(object $data, VK $vk, Bot $bot)
    {
        $this->data = $data;
        $this->vk = $vk;
        $this->bot = $bot;
    }

    public function handle()
    {
        $text = trim($this->data->object->text ?? '');

//        // Получаем команды для текущего бота
//        $commands = Command::where('bot_id', $this->bot->id)->pluck('command')->toArray();
//
//        // Проверяем, является ли сообщение одной из команд
//        if (in_array($text, $commands)) {
//            $this->vk->reply("Я получил команду: {$text}");
//            return;
//        }

        // Обработка специальных команд типа "привет"
        if (mb_strtolower($text) === 'привет') {
            $this->vk->reply('Привет!');
            return;
        }

        // Ответ по умолчанию
        $this->vk->reply('Я получил ваше сообщение: ' . $text);
    }
}
