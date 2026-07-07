<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'locale', 'is_verified',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_verified'       => 'boolean',
        ];
    }

    public function playerProfile()
    {
        return $this->hasOne(PlayerProfile::class);
    }

    public function clubProfile()
    {
        return $this->hasOne(ClubProfile::class);
    }

    public function agentProfile()
    {
    return $this->hasOne(Agent::class);
    }

    public function recruiterProfile()
    {
    return $this->hasOne(Recruiter::class);
    }

    public function shortlists()
    {
        return $this->hasMany(Shortlist::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latestOfMany();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function sentContactRequests()
    {
        return $this->hasMany(ContactRequest::class, 'requester_id');
    }

    public function receivedContactRequests()
    {
        return $this->hasMany(ContactRequest::class, 'target_user_id');
    }
}