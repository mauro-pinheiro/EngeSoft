<?php

namespace App\Http\Controllers;

use App\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function store()
    {
        $data = $this->validateRequest();
        Institution::create($data);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'nome' => 'required'
        ]);
    }
}
