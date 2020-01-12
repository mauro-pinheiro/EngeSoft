<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    // protected function validateRequest()
    // {
    //     return request()->validate([
    //         'title' => 'required',
    //         'file' => 'nullable',
    //     ]);
    // }

    public function store()
    {
        // dd(request()->all());
        $validator = Validator::make(
            request()->all(),
            [
                'title' => 'required',
                'file' => 'nullable',
            ]
        );


        $data = $validator->validate();
        $article = Article::create($data);
        $data = collect(request()->authors);
        return redirect('articles/' . $article->id);
    }

    public function addAuthor(Article $article)
    {
        // dd(request()->author);
        // $author = Author::where('email', Requ)
        $data = collect(request()->authors);

        $article->authors()->attach($data->map(function ($d) {
            return $d->id;
        }));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
