<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::with('autores', 'assuntos')->get();
        return view('livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.create', compact('autores', 'assuntos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:40',
            'editora' => 'required|integer',
            'edicao' => 'required|integer',
            'anoPublicacao' => 'required|max:40',
            'autores' => 'required|array',
            'assuntos' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {
            $livro = Livro::create([
                'titulo' => $request->titulo,
                'editora' => $request->editora,
                'edicao' => $request->edicao,
                'ano_publicacao' => $request->ano_publicacao,
            ]);

            $livro->autores()->attach($request->autores);
            $livro->assuntos()->attach($request->assuntos);
        });    
        return redirect()->route('livros.index')->with('success', 'O Livro foi cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required|max:40',
            'editora' => 'required|max:40',
            'edicao' => 'required|integer',
            'ano_publicacao' => 'required|digits:4',
            'autores' => 'required|array',
            'assuntos' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $livro) {
            $livro->update([
                'titulo' => $request->titulo,
                'editora' => $request->editora,
                'edicao' => $request->edicao,
                'ano_publicacao' => $request->ano_publicacao,
            ]);

            $livro->autores()->sync($request->autores);
            $livro->assuntos()->sync($request->assuntos);
        });

        return redirect()->route('livros.index')->with('success', 'O Livro foi atualizado com sucesso.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        return redirect()->route('livros.index')->with('success', 'O Livro foi excluído com sucesso.');
    }
}
