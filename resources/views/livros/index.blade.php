@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Livros</h1>
        <a href="{{ route('livros.create') }}" class="btn btn-primary">Adicionar Livro</a>
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
                <th>Título</th>
                <th>Editora</th>
                <th>Edição</th>
                <th>Ano de Publicação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->editora }}</td>
                    <td>{{ $livro->edicao }}</td>
                    <td>{{ $livro->anopublicacao }}</td>
                    <td>
                        <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmar a exclusão do livro?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection