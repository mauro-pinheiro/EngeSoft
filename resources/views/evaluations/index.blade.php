@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{config('app.name', 'Laravel')}} - Avaliações</h1>
    <table class='table table-hover table-bordered'>
        <thead>
            <th>Article</th>
            <th>Originalidade</th>
            <th>Conteúdo</th>
            <th>Apresentação</th>
            <th>Ações</th>
        </thead>

        <tbody id='edicoes-body'>
            @foreach ($evaluations as $evaluation)
            <tr>
                <td> {{ $evaluation->article->title}}</td>
                <td> {{ $evaluation->originality }}</td>
                <td> {{ $evaluation->content }}</td>
                <td> {{ $evaluation->presentation }}</td>
                <td>
                    <a href="{{url(route('evaluations.edit',['evaluation' => $evaluation]))}}">Editar</a>
                    {{-- <a href="{{url('/editions/'. $edition->id)}}">Visualizar</a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            {{-- <a id='btn-add' href="{{url(route('evaluations.edit', ['evaluation' => $evaluations->id]))}}">Add</a>
            --}}
        </tfoot>
    </table>
</div>
@endsection
