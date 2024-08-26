@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Assuntos</h1>
        <a href="{{ route('assuntos.create') }}" class="btn btn-primary">Adicionar Assunto</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assuntos as $assunto)
                <tr>
                    <td>{{ $assunto->id }}</td>
                    <td>{{ $assunto->descricao }}</td>
                    <td>
                        <a href="{{ route('assuntos.show', $assunto->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('assuntos.edit', $assunto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('assuntos.destroy', $assunto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmar a exclusão este assunto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection