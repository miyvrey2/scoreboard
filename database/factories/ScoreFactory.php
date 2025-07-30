<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_id' => Player::factory(),
            'game_id' => Game::factory(),
            'score' => $this->faker->numberBetween(0, 1000),
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
