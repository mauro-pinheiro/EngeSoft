@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h1>Adicionar Edição</h1>
    </center>
    <form action="{{url('themes')}}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" autocomplete="off">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descricao</label>
            <input type="text" class="form-control" name="description" autocomplete="off">
          </div>
        <button class="btn btn-primary">Adicionar</button>
      </form>
</div>
@endsection
