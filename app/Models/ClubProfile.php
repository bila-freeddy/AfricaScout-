<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubProfile extends Model
{
    protected $fillable = [
        'user_id', 'club_name', 'country', 'league', 'logo_url',
        'registration_number', 'subscription_plan', 'verification_status',
        'identity_document_type', 'identity_document_reference',
    ];

    protected function casts(): array
    {
        return [
            'verified' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}