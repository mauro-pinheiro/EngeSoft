@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h1>Submeter para {{$edition->theme->name}}</h1>
    </center>
    <form action="{{url('articles')}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="title">Título</label>
          <input type="text" class="form-control" name="title" aria-describedby="">
        </div>

        <div class="form-group">
          <label for="file">Arquivo</label>
          <input type="file" class="form-control-file" id="file" disabled>
        </div>

        {{-- <div class="form-group">
            <label>Edição: </label>
            <span>{{$edition->theme->name}}</span>
            <input type="text" class="form-control" name="edition" value="{{$edition->id}}" hidden>
        </div> --}}

        <div class="form-group">
            <label>Autores: </label>
            @foreach ($users as $user)
            <div class='form-check'>
            <input class='form-check-input' type="checkbox" name='autores' value="{{$user->id}}">
            <label class='form-check-label' for="{{'user-' . $user->id}}">{{$user->name}}</label>
            </div>

            @endforeach
        
        <button class="btn btn-primary">Adicionar</button>
      </form>
</div>
@endsection
