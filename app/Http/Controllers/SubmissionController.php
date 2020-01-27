<?php

namespace App\Http\Controllers;

use App\Article;
use App\Edition;
use App\Submission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
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
        return view('submissions.create', compact('edition'));
    }

    public function show(Submission $submission)
    {
        return view('submissions.show', compact('submission'));
    }
}
