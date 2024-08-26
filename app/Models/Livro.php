<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{

    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['id', 'titulo', 'editora', 'edicao', 'anopublicacao'];

    protected $primaryKey = 'id';

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livroautor');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livroassunto');
    }
}
