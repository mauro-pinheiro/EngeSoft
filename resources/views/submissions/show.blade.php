@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>{}</h1> --}}

    <form action="{{url(route('submissions.update',['submission' => $submission->id]))}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Artigo</label>
            <input type='text' value={{$submission->article->title}} readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="user">Usuário</label>
            <input type='text' value={{$submission->user->name}} readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="theme">Edição</label>
            <input type='text' value={{$submission->edition->theme->name}} readonly class="form-control">
        </div>
        <div class="form-check">
            <label for="coauthors">Autores (Selecione um para contato) </label><br>
            @forelse ($submission->article->authors as $author)
                @if($loop->first)
                <input type="radio" name="coauthors" class="form-check-input" checked>
                <label class="form-check-label">{{$author->name}}</label><br>
                @else
                <input type="radio" name="coauthors" class="form-check-input">
                <label class="form-check-label">{{$author->name}}</label><br>
                @endif
            @empty
                <span>Nenhum autor</span>
            @endforelse
        </div>

        <button type='submit' class="btn btn-primary">Concluir</button>
    </form>

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
