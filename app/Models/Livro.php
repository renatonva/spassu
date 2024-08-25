<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{

    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['cod', 'titulo', 'editora', 'edicao', 'anopublicacao'];

    protected $primaryKey = 'cod';

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'livro_cod', 'auto_codau');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'livro_cod', 'assunto_codas');
    }
}
