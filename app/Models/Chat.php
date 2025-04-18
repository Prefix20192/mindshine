<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'chat_id',
    ];

    public function bots(): BelongsToMany
    {
        return $this->belongsToMany(Bot::class);
    }
}
