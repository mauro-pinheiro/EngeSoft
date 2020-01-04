<?php

namespace App\Http\Controllers;

use App\Institution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store()
    {
        $data = $this->validateRequest();
        User::create(array_merge($data, ['senha' => Hash::make($data['senha'])]));
    }

    public function validateRequest()
    {
        return request()->validate([
            'nome' => 'required',
            'email' => 'required|unique:users|email',
            'institution_id' => '',
            'theme' => '',
            'endereco' => 'required',
            'senha' => 'required|min:8|confirmed'
        ]);
    }
}
