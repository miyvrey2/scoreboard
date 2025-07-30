<?php

namespace App\Console\Commands;

use App\Services\ScoreboardService;
use Illuminate\Console\Command;

class GetHighestScoresPerPlayer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scores:get-highest-per-player {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the highest scores per player for the given user ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');

        // Import the ScoreboardService
        $highestScores = ScoreboardService::getHighestScoresOfPlayer($userId);

        if (empty($highestScores)) {
            $this->info('No scores found.');
            return;
        }

        $this->info('Highest scores of player:' . $highestScores['player']);

        foreach ($highestScores['skills'] as $skill => $score) {
            $this->info("Skill: {$skill}, Score: {$score}");
        }

        $this->info('Done.');
    }
}
