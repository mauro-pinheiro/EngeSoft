<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store()
    {
        $temas = request()->themes;
        $temas_id = [];
        if ($temas != null) {
            foreach ($temas as $tema) {
                $temas_id = array_merge(
                    $temas_id,
                    [Theme::firstOrCreate(
                        ['name' => $tema]
                    )->id]
                );
            }
        }

        $data = $this->validateRequest();
        $user = User::create(array_merge($data, ['password' => Hash::make($data['password'])]));
        $user->themes()->attach($temas_id);
    }

    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'institution_id' => 'nullable',
            // 'themes' => 'nullable',
            'address' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
    }
}
