<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroassuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::with('assuntos')->get();
        return view('livroassunto.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $livros = Livro::all();
        $assuntos = Assunto::all();
        return view('livroassunto.create', compact('livros', 'assuntos'));
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
            'livro_id' => 'required|exists:livros,id',
            'assunto_id' => 'required|exists:assuntos,id',
        ]);

        DB::table('livroassunto')->insert([
            'livro_id' => $request->livro_id,
            'assunto_id' => $request->assunto_id,
        ]);

        return redirect()->route('livroassunto.index')->with('success', 'Vínculo criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livro::with('assuntos')->findOrFail($id);
        return view('livroassunto.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = Livro::with('assuntos')->findOrFail($id);
        $assuntos = Assunto::all();
        return view('livroassunto.edit', compact('livro', 'assuntos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'assuntos' => 'required|array',
        ]);

        $livro = Livro::findOrFail($id);
        $livro->assuntos()->sync($request->assuntos);

        return redirect()->route('livroassunto.index')->with('success', 'Vínculo atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $assunto_id)
    {
        DB::table('livroassunto')->where('livro_id', $id)->where('assunto_id', $assunto_id)->delete();

        return redirect()->route('livroassunto.index')->with('success', 'Vínculo removido com sucesso.');
    }
}
