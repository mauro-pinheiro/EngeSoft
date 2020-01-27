<?php

namespace App\Http\Controllers;

use App\Article;
use App\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        // dd($articles);
        foreach ($articles as $article) {
            $article->evaluations()->firstOrCreate(['user_id' => Auth::id()]);
        }
        $evaluations = Auth::user()->evaluations;
        return view('evaluations.index', compact('evaluations'));
    }

    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', compact('evaluation'));
    }

    public function update(Evaluation $evaluation)
    {
        // dd(request()->all());
        $evaluation->originality = request()->originality;
        $evaluation->content = request()->content;
        $evaluation->presentation = request()->presentation;
        // dd($evaluation);
        $evaluation->save();
        return redirect(route('evaluations.index'));
    }
}
