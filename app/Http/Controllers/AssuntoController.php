<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assuntos = Assunto::all();
        return view('assuntos.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assuntos.create');
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
            'descricao' => 'required|max:20',
        ]);

        Assunto::create([
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('assuntos.index')->with('success', 'O Assunto foi criado com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Assunto $assunto)
    {
        return view('assuntos.show', compact('assunto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Assunto $assunto)
    {
        return view('assuntos.edit', compact('assunto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assunto $assunto)
    {
        $request->validate([
            'descricao' => 'required|max:20',
        ]);

        $assunto->update([
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('assuntos.index')->with('success', 'O Assunto foi atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assunto $assunto)
    {
        $assunto->delete();

        return redirect()->route('assuntos.index')->with('success', 'O Assunto foi excluído com sucesso.');
    }
}
