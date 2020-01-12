@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>{}</h1> --}}
    <span>Titulo: {{$submission->article->title}}</span><br>
    <span>Usuario: {{$submission->user->name}}</span><br>
    <span>Edicao: {{$submission->edition->theme->name}}</span><br>
    <span>Autores:</span>
    @forelse ($submission->article->authors as $author)
        <br><span>{{$author->name}}</span>
    @empty
        <span>Nenhum autor</span>
    @endforelse
    <br>
    <form action="{{url('authors')}}" method="POST">
        @csrf
        <div class='from-group'>
            <label for="email">Author</label>
            <input type="email" name="email" class='form-control', placeholder="Email do Author">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
        <input type="text" name="submission_id" value="{{$submission->id}}" hidden>
    </form>
</div>
@endsection
