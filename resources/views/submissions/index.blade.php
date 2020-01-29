@extends('layouts.app')

@section('content')
<h1>{{config('app.name', 'Laravel')}} - Submissões</h1>
<table class='table table-hover table-bordered'>
    <thead>
        <th>Artigo</th>
        <th>Usuario</th>
        <th>Data</th>
        <th>Situação</th>
        <th>Ações</th>
    </thead>

    <tbody id='edicoes-body'>
        @foreach ($submissions as $submission)
            <tr>
                <td>{{$submission->article->title}}</td>
                <td>{{$submission->user->name}}</td>
                <td>{{$submission->created_at}}</td>
                <td>{{$submission->status}}</td>
                <td><a href="{{url(route('submissions.show',['submission'=> $submission->id]))}}">Visualizar</a></td>
            </tr>
        @endforeach
    </tbody>
    <footer>
    </footer>
</table>
@endsection
