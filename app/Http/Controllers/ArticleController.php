<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'file' => 'nullable'
        ]);
    }

    public function store()
    {
        Article::create($this->validateRequest());
    }
}
