<?php

namespace App\Http\Controllers;

use App\Edition;
use App\Theme;
use App\User;
use Carbon\Carbon;
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
            'user_id' => 'required'
        ]);
    }

    public function index()
    {
        $editions = Edition::all();
        foreach ($editions as $edition) {
            if (Carbon::now()->isAfter(Carbon::create($edition->year, $edition->month, 1))) {
                // array_merge($edition, ['situacao' => 'Publicada']);
                $edition->situacao = 'Publicada';
            } else {
                $edition->situacao = 'Não Publicada';
            }
            // dd($edition);
        }
        return view('editions.index', compact('editions'));
    }

    public function create()
    {
        $users = User::all();
        $themes = Theme::all();
        return view('editions.create', compact(['users', 'themes']));
    }

    public function store()
    {
        Edition::create($this->validateRequest());
        $editions = Edition::all();
        foreach ($editions as $edition) {
            if (Carbon::now()->isAfter(Carbon::create($edition->year, $edition->month, 1))) {
                // array_merge($edition, ['situacao' => 'Publicada']);
                $edition->publicada = true;
            } else {
                $edition->publicada = false;
            }
            // dd($edition);
        }
        return redirect('editions');
    }

    public function submit(Edition $edition)
    {
        $users = User::all();
        return view('articles.create', compact(['edition', 'users']));
    }

    public function show(Edition $edition)
    {
        return view('editions.show', compact('edition'));
    }
}
