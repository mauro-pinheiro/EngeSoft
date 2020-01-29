@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{config('app.name', 'Laravel')}} - Edicões</h1>
    <table class='table table-hover table-bordered'>
    <thead>
        <th>Tema</th>
        <th>Editor-Chefe</th>
        <th>Publicão</th>
        <th>Situação</th>
        <th>Ações</th>
    </thead>

    <tbody id='edicoes-body'>
        @foreach ($editions as $edition)
            <tr>
            <td> {{ $edition->theme->name }}</td>
            <td> {{ $edition->leadEditor->name }}</td>
            <td> {{ $edition->month . '/' . $edition->year }}</td>
            <td> {{ $edition->publicada }}</td>
            <td>
                <a href="{{url('/editions/'. $edition->id . '/submit')}}">Submeter</a>
                <a href="{{url('/editions/'. $edition->id)}}">Visualizar</a>
            </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
    <a id='btn-add' href="{{url('editions/create')}}">Add</a>
    </tfoot>
</table>
</div>
@endsection
