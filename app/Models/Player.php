<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'scores')
                    ->withPivot('score')
                    ->withTimestamps();
    }
}
