<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumor extends Model
{
    protected $table    = 'rumores';
    public $timestamps  = false;
    protected $fillable = [
        'piloto','equipo','color','tag','credibilidad','texto','fuente','fecha','activo'
    ];
}
