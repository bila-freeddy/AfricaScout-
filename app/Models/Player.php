<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = [
        'name', 'initials', 'photo', 'status',
        'nationality', 'age', 'position', 'foot',
        'height', 'weight', 'available',
        'matchs', 'buts', 'passes', 'jaunes', 'rouges',
        'club', 'agent',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}