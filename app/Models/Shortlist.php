<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shortlist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'is_private',
    ];

    protected function casts(): array
    {
        return [
            'is_private' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(PlayerProfile::class, 'shortlist_players', 'shortlist_id', 'player_profile_id')
            ->withPivot(['notes', 'added_at']);
    }
}