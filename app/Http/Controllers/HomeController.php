<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Applicant;
use App\Models\GamesPlayed;
use App\Models\OperatorGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            if ($user->hasRole('applicant')) {
                return redirect(route('applicants.dashboard'));
            } else if ($user->hasRole('operator')) {
                return redirect(route('operators.dashboard'));
            }
        }

        $applicant_count = Applicant::count();
        $applicant_pending_count = Applicant::where('application_status', 1)->count();
        $applicant_disapproved_count = Applicant::where('application_status', 3)->count();
        $applicant_approved_count = Applicant::where('application_status', 2)->count();
        $operator_count = Operator::count();
        $operator_games_count = OperatorGame::count();
        $games_played_count = GamesPlayed::count();
        $games_played = GamesPlayed::select('amount')->get();
        $total_amount_generated = 0;
        foreach ($games_played as $game){
            $total_amount_generated += $game->amount;
        }
        $tax_generated = $total_amount_generated * 0.075;
        return view('home', compact('applicant_count', 'operator_count', 'operator_games_count', 'applicant_pending_count', 'applicant_disapproved_count', 'applicant_approved_count', 'games_played_count', 'total_amount_generated', 'tax_generated'));
    }
}
