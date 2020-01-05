<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'file' => 'nullable',
        ]);
    }

    public function store()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'title' => 'required',
                'file' => 'nullable',
            ]
        );
        $data = $validator->validate();
        Article::create($data);
    }

    public function addAuthor(Article $article)
    {
        // dd(request()->author);
        $data = collect(request()->author);

        $article->authors()->attach($data->map(function ($d) {
            return $d->id;
        }));
    }
}
