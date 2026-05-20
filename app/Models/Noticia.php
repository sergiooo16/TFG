<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table    = 'noticias';
    public $timestamps  = false;
    protected $fillable = [
        'titulo','extracto','imagen','url','fuente','fecha','activo'
    ];
}
