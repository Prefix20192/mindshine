<?php

namespace App\Http\Controllers\Api\v1\VK;

use App\Http\Controllers\Controller;
use App\Models\Bot as Bot;
use DigitalStars\SimpleVK\Message as vkMessage;
use DigitalStars\SimpleVK\SimpleVK as VK;
use DigitalStars\SimpleVK\Bot as vkBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaseVkController extends Controller
{
    public function hubBots(Request $request)
    {
        $bot = Bot::query()->where('id', '=', $request->input('bot'))->first();
        $vk = VK::create($bot->token, $bot->version)->setConfirm($bot->confirm_str)->setUserLogError('244237036');
        $vkBot = vkBot::create($vk);
        $msg = vkMessage::create( $vk );

        $vkBot->cmd( 'date', '/дата' )->text( 'Точное время: ' . date( 'd.m.Y H:i:s' ) );
        $vkBot->run();
    }
}
