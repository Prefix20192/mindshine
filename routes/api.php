<?php

use App\Http\Controllers\Api\v1\VK\BaseVkController;
use App\Http\Middleware\CheckSubsBot;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('throttle:60,1')->prefix('v1')->group(function (){
    Route::post('vk/callback', [BaseVkController::class, 'hubBots'])->middleware(CheckSubsBot::class);
});
