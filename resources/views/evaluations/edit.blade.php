@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h1>Adicionar Edição</h1>
    </center>
    <form action="{{url(route('evaluations.update', ["evaluation" => $evaluation]))}}" method="POST">
        @csrf

        <div class="form-group">
            {{-- <label for="volume">Volume</label> --}}
            <input type="text" class="form-control" name="artigo" value="{{$evaluation->article->title}}">
            {{-- <small name="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>

        <div class="form-group">
            <label for="number">Originalidade</label>
            <input type="number" class="form-control" name="originality" min='0' max='10' step='.5'>
        </div>

        <div class="form-group">
            <label for="number">Conteúdo</label>
            <input type="number" class="form-control" name="content" min='0' max='10' step='.5'>
        </div>

        <div class="form-group">
            <label for="number">Apresentação</label>
            <input type="number" class="form-control" name="presentation" min='0' max='10' step='.5'>
        </div>
        <button class="btn btn-primary">Adicionar</button>
    </form>
</div>
@endsection
