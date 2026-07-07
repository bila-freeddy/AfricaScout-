<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayerProfile extends Model
{
    protected $fillable = [
        'user_id',

        'first_name',
        'last_name',
        'photo',
        'date_of_birth',
        'nationality',
        'bio',

        'position',
        'strong_foot',

        'height_cm',
        'weight_kg',

        'contract_status',
        'contract_end_date',

        'declares_free_agent',
        'free_agent_proof_type',
        'free_agent_proof_reference',

        'club_user_id',
        'agent_user_id',

        'available',
    ];

    protected $casts = [
        'date_of_birth'       => 'date',
        'contract_end_date'   => 'date',
        'declares_free_agent' => 'boolean',
        'available'           => 'boolean',
    ];

    protected $appends = [
        'age',
        'photo_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(User::class, 'club_user_id');
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_user_id');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(PlayerVideo::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth?->age;
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        return asset('storage/' . $this->photo);
    }
}