@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h1>Adicionar Edição</h1>
    </center>
    <form action="{{url('editions')}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="volume">Volume</label>
          <input type="text" class="form-control" name="volume">
          {{-- <small name="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>

        <div class="form-group">
          <label for="number">Número</label>
          <input type="text" class="form-control" name="number">
        </div>

        <div class="form-group">
            <label for="month">Mês</label>
            <input type="text" class="form-control" name="month">
        </div>

        <div class="form-group">
            <label for="year">Ano</label>
            <input type="text" class="form-control" name="year">
          </div>

          <div class="form-group">
            <label for="theme_id">Tema</label>
            <select class="form-control" name="theme_id">
                @foreach ($themes as $theme)
                    <option value={{$theme->id}}>{{$theme->name}}</option>
                @endforeach
            </select>
            <a href="{{url('themes/create')}}">Novo</a>
          </div>

          <div class="form-group">
            <label for="user_id">Editor-Chefe</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value={{$user->id}}>{{$user->name}}</option>
                @endforeach
            </select>
          </div>

        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button class="btn btn-primary">Adicionar</button>
      </form>
</div>
@endsection
