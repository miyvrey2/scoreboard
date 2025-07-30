<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Player;
use App\Models\Score;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ScoreboardService;

class ScoreboardServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array
     */
    public function setupData(): array
    {
        // Create players
        $players = Player::factory(10)->create();

        // Create skills
        $reactivity = Skill::create(['name' => 'reactivity']);
        $precision = Skill::create(['name' => 'precision']);
        $strategy = Skill::create(['name' => 'strategy']);

        // Create games
        $darts = Game::create(['name' => 'darts']);
        $tableTennis = Game::create(['name' => 'table tennis']);
        $pool = Game::create(['name' => 'pool']);

        // Attach skills to games
        $darts->skills()->attach([$reactivity]);
        $tableTennis->skills()->attach([$precision]);
        $pool->skills()->attach([$strategy]);

        return [$players, $darts, $tableTennis, $pool];
    }

    public function test_it_calculates_highest_score_per_skill()
    {
        // Set up the data for the test
        [$players, $darts, $tableTennis, $pool] = $this->setupData();

        // Create specific scores for players in each game
        Score::create(['game_id' => $darts->id, 'player_id' => $players[0]->id, 'score' => 80]);
        Score::create(['game_id' => $darts->id, 'player_id' => $players[1]->id, 'score' => 90]); // winner with reactivity
        Score::create(['game_id' => $tableTennis->id, 'player_id' => $players[0]->id, 'score' => 70]);
        Score::create(['game_id' => $tableTennis->id, 'player_id' => $players[2]->id, 'score' => 85]); // winner with precision
        Score::create(['game_id' => $pool->id, 'player_id' => $players[1]->id, 'score' => 88]);
        Score::create(['game_id' => $pool->id, 'player_id' => $players[2]->id, 'score' => 92]); // winner with strategy

        // Calculate the highest scores per skill
        $highestScores = ScoreboardService::getHighestScoresPerSkill();

        // Assert that the highest scores are calculated correctly
        $this->assertCount(3, $highestScores);

        // Check reactivity skill
        $this->assertEquals('reactivity', $highestScores[0]['skill']);
        $this->assertEquals($players[1]->name, $highestScores[0]['player']);
        $this->assertEquals(90, $highestScores[0]['score']);

        // Check precision skill
        $this->assertEquals('precision', $highestScores[1]['skill']);
        $this->assertEquals($players[2]->name, $highestScores[1]['player']);
        $this->assertEquals(85, $highestScores[1]['score']);

        // Check strategy skill
        $this->assertEquals('strategy', $highestScores[2]['skill']);
        $this->assertEquals($players[2]->name, $highestScores[2]['player']);
        $this->assertEquals(92, $highestScores[2]['score']);
    }

    public function test_it_gets_highest_scores_of_player()
    {
        // Set up the data for the test
        [$players, $darts, $tableTennis, $pool] = $this->setupData();

        // Create scores for a specific player
        Score::create(['game_id' => $darts->id, 'player_id' => $players[0]->id, 'score' => 80]);
        Score::create(['game_id' => $tableTennis->id, 'player_id' => $players[0]->id, 'score' => 70]);
        Score::create(['game_id' => $pool->id, 'player_id' => $players[0]->id, 'score' => 88]);

        // Get the highest scores of the player
        $highestScores = ScoreboardService::getHighestScoresOfPlayer($players[0]->id);

        // Assert that the highest scores are calculated correctly
        $this->assertCount(2, $highestScores);

        $this->assertEquals(80, $highestScores['skills']['reactivity']);
        $this->assertEquals(70, $highestScores['skills']['precision']);
        $this->assertEquals(88, $highestScores['skills']['strategy']);
    }
}
