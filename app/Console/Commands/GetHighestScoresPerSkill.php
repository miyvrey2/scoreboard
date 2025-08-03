<?php

namespace App\Console\Commands;

use App\Services\ScoreboardService;
use Illuminate\Console\Command;

class GetHighestScoresPerSkill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scores:get-highest-per-skill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the highest scores for each skill per game and player from the scoreboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Import the ScoreboardService
        $highestScores = ScoreboardService::getHighestScoresPerSkill();

        if (empty($highestScores)) {
            $this->info('No scores found.');
            return;
        }

        $this->info('Highest scores per skill:');

        $this->table(["Skill", "Player", "Score"], array_values($highestScores));
    }
}
