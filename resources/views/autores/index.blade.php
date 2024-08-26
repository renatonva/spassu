@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Autores</h1>
        <a href="{{ route('autores.create') }}" class="btn btn-primary">Adicionar Autor</a>
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
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td>
                        <a href="{{ route('autores.show', $autor->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('autores.edit', $autor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('autores.destroy', $autor->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmar exclusão este autor?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection