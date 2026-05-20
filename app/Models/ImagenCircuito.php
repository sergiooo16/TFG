<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenCircuito extends Model
{
    protected $table      = 'imagenescircuitos';
    protected $primaryKey = 'id';
    public    $keyType    = 'string';
    public    $incrementing = false;
    public    $timestamps = false;

    protected $fillable = ['id', 'nombre', 'imagen'];
}
