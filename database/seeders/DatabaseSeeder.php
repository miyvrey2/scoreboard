<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
use App\Models\Score;
use App\Models\Skill;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $players = Player::factory(10)->create();

        // Create skills
        $reactivity = Skill::create(['name' => 'reactivity']);
        $precision = Skill::create(['name' => 'precision']);
        $strategy = Skill::create(['name' => 'strategy']);

        // Create games and attach skills
        Game::create(['name' => 'darts'])->skills()->attach([$precision, $strategy]);
        Game::create(['name' => 'table tennis'])->skills()->attach([$precision, $reactivity]);
        Game::create(['name' => 'pool'])->skills()->attach([$precision, $strategy]);

        // Create scores and use the existing players and games
        Score::factory(100)
             ->recycle([$players, Game::all()])
             ->create();
    }
}
