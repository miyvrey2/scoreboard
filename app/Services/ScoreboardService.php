<?php

namespace App\Services;

use App\Models\Player;
use App\Models\Skill;

class ScoreboardService
{
    /**
     * Get the top scores from the scoreboard.
     *
     * @return array
     */
    public static function getHighestScoresPerSkill(): array
    {
        $results = [];
        $playerScores = [];

        // Eager load games and scores with players to minimize queries
        $skills = Skill::with('games.scores.player')->get();

        // If there are no skills, return an empty array
        if ($skills->isEmpty()) {
            return [];
        }

        foreach ($skills as $skill) {
            foreach ($skill->games as $game) {
                foreach ($game->scores as $score) {

                    // grep the player ID and note the highest score
                    $playerId = $score->player->id;
                    $playerScores[$playerId] = $playerScores[$playerId] ?? 0;
                    $playerScores[$playerId] = ($playerScores[$playerId] > $score->score) ? $playerScores[$playerId] : $score->score;
                }
            }

            // Sort the scores to find the highest for this skill
            arsort($playerScores);
            $topPlayerId = array_key_first($playerScores);
            $topScore = $playerScores[$topPlayerId];

            // Write down the result for this skill
            $results[] = [
                'skill' => $skill->name,
                'player' => Player::find($topPlayerId)->name,
                'score' => $topScore
            ];
        }

        return $results;
    }
}
