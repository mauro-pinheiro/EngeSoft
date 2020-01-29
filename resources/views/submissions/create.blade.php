@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h1>Submeter</h1>
    </center>
    <form action="{{url('/submissions')}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="title">Título</label>
          <input type="text" class="form-control" name="title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <label for="file">Arquivo</label>
          <input type="file" class="form-control-file" id="file" disabled>
        </div>

        <div class="form-group">
            <label for="edition">Edição</label>
            <select class="form-control">
                @foreach ($editions as $e)
                @if($e->id === $edition->id)
                    <option value={{$e->id}} selected>{{$e->theme->name}}</option>
                @else
                    <option value={{$e->id}}>{{$e->theme->name}}</option>
                @endif
                @endforeach
            </select>
          </div>
         <div class="form-group">
            <input class="form-control" type='text' name='edition_id' value="{{$edition->id}}" hidden>
        </div>
        <button class="btn btn-primary">Adicionar</button>
      </form>
</div>
@endsection
