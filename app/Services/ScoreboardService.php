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

        // Eager load games and scores with players to minimize queries
        $skills = Skill::with('games.scores.player')->get();

        // If there are no skills, return an empty array
        if ($skills->isEmpty()) {
            return [];
        }

        foreach ($skills as $skill) {

            // reset the player scores for each skill
            $playerScores = [];

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

        // sort by the key 'score' in descending order
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }

    public static function getHighestScoresOfPlayer($player_id): array
    {
        // Eager load scores and their related games and skills for the player
        $player = Player::with('scores.game.skills')->find($player_id);

        if (!$player) {
            return [];
        }

        $skillScores = [];

        foreach ($player->scores as $score) {
            foreach ($score->game->skills as $skill) {
                $skillId = $skill->id;
                $skillScores[$skillId] = $skillScores[$skillId] ?? 0;
                $skillScores[$skillId] = ($skillScores[$skillId] > $score->score) ? $skillScores[$skillId] : $score->score;
            }
        }

        // Sort the scores to find the highest for this skill
        arsort($skillScores);

        // Write down the skill scores for this user
        $results = [
            'player' => $player->name,
            'skills' => collect($skillScores)->mapWithKeys(function ($val, $skillId) {
                return [Skill::find($skillId)->name => $val];
            })->toArray(),
        ];

        return $results;
    }
}
