<?php

namespace App\Http\Controllers;

use App\Edition;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    protected function validateRequest()
    {
        return request()->validate([
            'volume' => 'required',
            'number' => 'required',
            'month' => 'nullable',
            'year' => 'nullable',
            'theme_id' => 'required',
        ]);
    }

    public function store()
    {
        Edition::create($this->validateRequest());
    }
}
