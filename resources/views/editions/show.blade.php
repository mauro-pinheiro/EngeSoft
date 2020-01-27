@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$edition->theme->name}}</h1>
    <span>Volume: {{$edition->volume}}</span><br>
    <span>Number: {{$edition->number}}</span><br>
    <span>Publicacao: {{$edition->month . '/' . $edition->year}}</span><br>
    <span>Artigos Submetidos</span><br>
    @foreach ($edition->submissions as $submission)
        <br><span>$submission->article->title</span>
    @endforeach
</div>
@endsection
