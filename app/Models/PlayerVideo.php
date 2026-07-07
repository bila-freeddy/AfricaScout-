<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerVideo extends Model
{
    protected $fillable = [
        'player_profile_id',
        'title',
        's3_key',
        'thumbnail_url',
        'duration_seconds',
        'views_count',
        'is_highlight',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_highlight' => 'boolean',
        ];
    }

    public function playerProfile(): BelongsTo
    {
        return $this->belongsTo(PlayerProfile::class);
    }
}