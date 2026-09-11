<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'participant_1_id',
        'participant_2_id',
        'subject',
        'last_message_at',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    public function participantOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'participant_1_id');
    }

    public function participantTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'participant_2_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('participant_1_id', $userId)
            ->orWhere('participant_2_id', $userId);
    }

    public function otherParticipant(int $currentUserId): ?User
    {
        return $this->participant_1_id === $currentUserId
            ? $this->participantTwo
            : $this->participantOne;
    }
}