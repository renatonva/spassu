<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autor extends Model
{
    
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['id', 'nome'];

    protected $primaryKey = 'id';

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livroautor');
    }
}
