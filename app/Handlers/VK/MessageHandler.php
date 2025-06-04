<?php

namespace App\Handlers\VK;
use App\Enums\ActionType\ActionTypeEnums;
use App\Models\Bot;
use App\Models\Chat;
use App\Models\Command;
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
//        if (($this->data->object->peer_id - 2000000000) < 0) {
//            $this->vk->reply('🚫 Не возможно привязать чат к боту! Используй это команду в беседе!');
//            return;
//        }

        $text = mb_strtolower($this->data->object->text);
        $from_id = $this->data->object->from_id;
        $peer_id = $this->data->object->peer_id;


        $chat = Chat::query()->where('chat_id', '=', $peer_id)->first();
        if(!$chat) return;

        $command = Command::query()
            ->where('bot_id', '=', $this->bot->id)
            ->where('chat_id', '=', $chat->id)
            ->where('command','=', $text)
            ->first();

        if(!$command) return;
        $this->processCommand($command);
    }

    private function processCommand($command)
    {
        $actionType = ActionTypeEnums::from($command->action_type_code->value);
        $responseData = $command->data;
        return match ($actionType) {
            ActionTypeEnums::MESSAGE => $this->vk->reply($responseData['text']),
        };
    }
}
