<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function validadeRequest()
    {
        return request()->validate([
            'name' => 'required|unique:themes',
            'description' => 'nullable'
        ]);
    }
    public function store()
    {
        Theme::create($this->validadeRequest());
        return redirect()->back();
    }

    public function create()
    {
        return view('themes.create');
    }
}
