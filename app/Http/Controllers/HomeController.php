<?php

namespace App\Http\Controllers;

use App\Edition;
use App\Submission;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $submissions = Submission::where('id_user', Auth::id())->first();
        $editions = Edition::all();
        $evaluations = Auth::user()->evaluations;
        return view('home', compact(['submissions', 'editions', 'evaluations']));
    }
}
