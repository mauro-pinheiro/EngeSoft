<?php

namespace App\Http\Controllers;

use App\Article;
use App\Edition;
use App\Submission;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::all();
        return view('submissions.index', compact('submissions'));
    }

    public function update(Submission $submission)
    {
        if (!empty($submission->article->authors)) {
            $submission->status = 'P';
        }
        $submission->save();
        return redirect(route('editions.show',['edition'=>$submission->edition->id]));
    }

    public function store()
    {
        // dd(request()->all());

        $validator = Validator::make(
            request()->all(),
            [
                'number' => 'nullable',
                'title' => 'required',
                'file' => 'nullable',
                'edition_id' => 'required'
            ]
        );

        $data = $validator->validate();
        // dd($data);

        $edition = Edition::find($data['edition_id']);
        $article = Article::create(['title' => $data['title']]);
        $submission = Submission::create(array_merge($data, ['status' => 'I']));
        $submission->edition()->associate($edition);
        $submission->user()->associate(Auth::user());
        $submission->article()->associate($article);
        $submission->save();

        return redirect('submissions/' . $submission->id);
        // $article->save();
    }

    public function create(Edition $edition)
    {
        $editions = Edition::all()->filter(function ($k, $v) {
            if (Carbon::now()->isBefore(Carbon::create($k->year, $k->month, 1))) {
                return $k;
            }
        })->all();
        return view('submissions.create', compact(['edition', 'editions']));
    }

    public function show(Submission $submission)
    {
        return view('submissions.show', compact('submission'));
    }
}
