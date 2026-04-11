<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $fillable = [
        'player_id', 'title', 'url', 'thumbnail', 'duration', 'views',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}