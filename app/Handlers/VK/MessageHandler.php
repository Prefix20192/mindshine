<?php

namespace App\Handlers\VK;
use App\Models\Bot;
use App\Models\Chat;
use DigitalStar\vk_api\vk_api as VK;
use Illuminate\Support\Facades\DB;

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

    public function handle(): void
    {
        $command = $this->data->object->text;

        if (mb_strtolower($command) == '+рег') {
            if (($this->data->object->peer_id - 2000000000) < 0) {
                $this->vk->reply('🚫 Не возможно привязать чат к боту! Используй это команду в беседе!');
                return;
            }

            $chat = Chat::query()->firstOrCreate([
                'platform' => 'vkontakte',
                'chat_id' => $this->data->object->peer_id
            ]);

            $isAttached = DB::table('bot_chat')
                ->where('bot_id', '=', $this->bot->id)
                ->where('chat_id','=', $chat->id)
                ->exists();

            if (!$isAttached) {
                $this->bot->chats()->attach($chat->id);
                $message = "✅ Чат успешно привязан к боту!";
            } else {
                $message = "ℹ️ Чат уже был привязан ранее.";
            }

            $this->vk->reply($message);
        }

//        // Получаем команды для текущего бота
//        $commands = Command::where('bot_id', $this->bot->id)->pluck('command')->toArray();
//
//        // Проверяем, является ли сообщение одной из команд
//        if (in_array($text, $commands)) {
//            $this->vk->reply("Я получил команду: {$text}");
//            return;
//        }

//        // Обработка специальных команд типа "привет"
//        if (mb_strtolower($message) === 'привет') {
//            $this->vk->reply('Привет!');
//            return;
//        }
    }
}
