<?php

namespace App\Http\Middleware;

use App\Models\Bot;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubsBot
{
    public function handle(Request $request, Closure $next): Response
    {
        $group_id = $request->input('group_id');
        $botId = $request->query('bot');
        $bot = Bot::query()->where('id_group', '=', $group_id)->where('id', '=', $botId)->first();

        if (is_null($bot)) {
            return response()->json("[Ошибка]: Бот не найден!", 404);
        }

        if (is_null($bot->confirm_str)) {
            return response()->json("[Ошибка]: Не найдена строка которую должен вернуть сервер (ВК).", 404);
        }

        if ($bot->subscriptions[0]->status == 'active') {
            return $next($request);
        }

        return response()->json("[Ошибка]: Лицензия отсутствует!", 403);
    }
}
