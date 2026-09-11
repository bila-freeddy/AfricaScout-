<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    protected $fillable = [
        'player_profile_id',
        'from_club_id',
        'to_club_id',
        'amount_usd',
        'commission_rate',
        'commission_amount',
        'status',
        'commission_signed',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'commission_signed' => 'boolean',
            'completed_at'      => 'datetime',
        ];
    }

    public function playerProfile(): BelongsTo
    {
        return $this->belongsTo(PlayerProfile::class);
    }

    public function fromClub(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_club_id');
    }

    public function toClub(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_club_id');
    }
}