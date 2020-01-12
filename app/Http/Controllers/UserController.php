<?php

namespace App\Http\Controllers;

use App\Article;
use App\Institution;
use App\Submission;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store()
    {
        // $temas = request()->themes;
        // $temas_id = [];
        // if ($temas != null) {
        //     foreach ($temas as $tema) {
        //         $temas_id = array_merge(
        //             $temas_id,
        //             [Theme::firstOrCreate(
        //                 ['name' => $tema]
        //             )->id]
        //         );
        //     }
        // }

        $data = $this->validateRequest();
        $user = User::create(array_merge($data, ['password' => Hash::make($data['password'])]));
        // $user->themes()->attach($temas_id);
    }

    public function validateRequest()
    {
        return request()->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'institution_id' => 'sometimes|required',
                // 'themes' => 'nullable',
                'address' => 'required',
                'password' => 'required|min:8|confirmed'
            ],
            [
                'required' => 'O :attribute é obrigatório.',
                'email.unique' => 'Email já utilizado por outro usuário.',
                'password.min' => 'O :attribute precisa ter no mínimo :min',
                'password.confirmed' => 'As senhas não conferem'
            ]
        );
    }

    public function find()
    {
        // dd(request()->all());

        $data = Validator::make(request()->all(), [
            'submission_id' => 'required',
            'email' => 'required'
        ])->validate();

        // dd($data);
        $user = User::where('email', $data['email'])->first();
        $submission = Submission::find($data['submission_id']);
        // dd($submission);
        if ($user) {
            $submission->article->authors()->save($user);
            return redirect('submissions/' . $submission->id);
        } else {
            return redirect('authors/create')
                ->with('email', $data['email'])
                ->with('submission', $submission->id);
        }
    }

    public function createAuthor()
    {
        $institutions = Institution::all();
        return view('authors.create', compact('institutions'));
    }

    public function storeAuthor()
    {
        $data = Validator::make(
            request()->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'institution_id' => 'required',
                // 'themes' => 'nullable',
                'address' => 'required',
                'password' => 'required|min:8'
            ]
        )->validate();

        // $data = $this->validateRequest();
        $submission = Submission::find(request()->submission_id);
        $user = User::create(array_merge($data, ['password' => Hash::make($data['password'])]));
        $submission->article->authors()->save($user);
        return redirect('submissions/' . $submission->id);
    }
}
