<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
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
        Player::factory(10)->create();

        Game::create(['name' => 'darts']);
        Game::create(['name' => 'table tennis']);
        Game::create(['name' => 'pool']);

        Skill::create(['name' => 'reactivity']);
        Skill::create(['name' => 'presision']);
        Skill::create(['name' => 'strategy']);
    }
}
