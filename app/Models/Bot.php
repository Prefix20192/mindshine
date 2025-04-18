<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bot extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'token',
        'version',
        'url_handler',
    ];

    protected $casts = [
        'version' => 'float',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function latestSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->latest();
    }

    public static function boot(): void
    {
        parent::boot();

        static::created(function ($bot) {
            if ($bot->platform === 'vkontakte' && empty($bot->url_handler)) {
                $bot->update([
                    'url_handler' => url('/api/v1/vk/callback?bot=' . $bot->id)
                ]);
            }
        });

        static::saving(function ($bot) {
            if ($bot->platform === 'telegram') {
                if (!preg_match('/^[0-9]+:[a-zA-Z0-9_-]+$/', $bot->token)) {
                    throw new \Exception('Invalid Telegram bot token format');
                }
                $bot->version = null;
                $bot->url_handler = null;
            } elseif ($bot->platform === 'vkontakte') {
                if (empty($bot->version)) {
                    throw new \Exception('VK version is required');
                }
            }
        });
    }

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class);
    }
}
