@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h1>Adicionar Author</h1>
    </center>
    <form action="{{url('authors/store')}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" value="{{session('email')}}" readonly>
        </div>

        <div class="form-group">
            <label for="address">Endereco</label>
            <input type="text" class="form-control" name="address">
          </div>

          <div class="form-group">
            <label for="institution_id">Instituicoes</label>
            <select class="form-control" name="institution_id">
                @foreach ($institutions as $institution)
                    <option value={{$institution->id}}>{{$institution->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            {{-- <label for="address">Endereco</label> --}}
            <input type="text" class="form-control" name="password" value="teste@123" hidden>
            <input type="text" class="form-control" name="submission_id" value="{{session('submission')}}" hidden>
          </div>
        <button class="btn btn-primary">Salvar</button>
      </form>
</div>
@endsection
