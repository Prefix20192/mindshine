<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Command extends Model
{
    use HasFactory;

    protected $table = 'commands';

    protected $fillable = [
        'bot_id',
        'chat_id',
        'name',
        'command',
        'action_type_code',
        'data'
    ];

    protected $casts = [
        'action_type_code' => 'integer',
        'data' => 'array'
    ];

    public function bot(): belongsTo
    {
        return $this->belongsTo(Bot::class);
    }

    public function chat(): belongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
