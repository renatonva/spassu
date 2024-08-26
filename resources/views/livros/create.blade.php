@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Livro</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('livros.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
        </div>

        <div class="mb-3">
            <label for="editora" class="form-label">Editora</label>
            <input type="text" class="form-control" id="editora" name="editora" value="{{ old('editora') }}" required>
        </div>

        <div class="mb-3">
            <label for="edicao" class="form-label">Edição</label>
            <input type="number" class="form-control" id="edicao" name="edicao" value="{{ old('edicao') }}" required>
        </div>

        <div class="mb-3">
            <label for="anopublicacao" class="form-label">Ano de Publicação</label>
            <input type="text" class="form-control" id="anopublicacao" name="anopublicacao" value="{{ old('anopublicacao') }}" maxlength="4" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection