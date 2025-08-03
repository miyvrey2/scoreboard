<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    /** @use HasFactory<\Database\Factories\SkillFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    public function scores()
    {
        return $this->hasManyThrough(Score::class, Game::class);
    }
}
