@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    <span>Autores</span>
    <br>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">
        @forelse ($article->authors as $author)
            {{$author->name . "; "}}
        @empty
            Vazio
        @endforelse
    </textarea>
    
</div>
@endsection
