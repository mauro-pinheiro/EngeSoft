@extends('layouts.app')


@section('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class='container' id='home-body'>

    <section id="edicoes">
      <table class='table table-hover table-bordered'>
        <header>
          <h2>Edições</h2>
        </header>
        <thead>
          <th class="first-th">Tema</th>
          <th>Publicação</th>
        </thead>
        <tbody>
            @foreach ($editions as $edition)
            <tr>
            <td> {{ $edition->theme->name }}</td>
            <td> {{ $edition->month . '/' . $edition->year }}</td>
            </tr>
        @endforeach
        </tbody>
      </table>
    </section>

    <section id="submissoes">
        <table class='table table-hover table-bordered'>
        <header>
          <h2>Minhas Submissões</h2>
        </header>
        <thead>
          <th class="first-th">Titulo</th>
          <th>Contato</th>
          <th>Situação</th>
        </thead>
        <tbody>
          <!-- Aqui vem as submissõe -->
        </tbody>
      </table>
    </section>

    <section id="avaliacoes">
        <table class='table table-hover table-bordered'>
        <header>
          <h2>Minhas Avaliações</h2>
        </header>
        <thead>
          <th class="first-th">Titulo</th>
          <th>Nota</th>
        </thead>
        <tbody>
          <!-- Aqui vem as avaliações -->
        </tbody>
      </table>
    </section>
  </div>
@endsection
