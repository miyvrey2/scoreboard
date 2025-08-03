<?php

namespace App\Http\Controllers;

use App\Services\ScoreboardService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $highScores['skill'] = ScoreboardService::getHighestScoresPerSkill();
        $highScores['player'] = ScoreboardService::getHighestScoresOfPlayer(1);

        return view('dashboard', compact('highScores'));
    }

    /**
     * Display the welcome view.
     *
     * @return \Illuminate\View\View
     */
    public function welcome(): View
    {
        $highScores['skill'] = ScoreboardService::getHighestScoresPerSkill();
        $highScores['player'] = ScoreboardService::getHighestScoresOfPlayer(1);

        return view('welcome', compact('highScores'));
    }
}
