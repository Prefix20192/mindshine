<?php

namespace App\Http\Controllers\Api\v1\VK;

use App\Handlers\VK\MessageHandler;
use App\Http\Controllers\Controller;
use App\Models\Bot;
use DigitalStar\vk_api\vk_api as VK;
use Illuminate\Http\Request;

class BaseVkController extends Controller
{
    public function hubBots(Request $request)
    {
        $bot = Bot::query()->where('id', '=', $request->input('bot'))->first();
        $vk = VK::create( $bot->token, $bot->version)->setConfirm($bot->confirm_str);
        $vk->initVars($id, $message, $payload, $user_id, $type, $data);
        if ($type == 'message_new') {
            (new MessageHandler((object)$data, $vk, $bot))->handle();
            return response('ok');
        }
        return response('Unsupported event type');
    }
}
