<?php

namespace App\Http\Controllers;

use App\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    public function store()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'number' => 'required',
            ]
        );

        $article = request()->article;
        $edition = request()->edition;
        $data = $validator->validate();
        $data = array_merge($data, ['status' => 'P']);
        $article->editions()->attach($edition->id, $data);
        // $article->save();
    }
}
