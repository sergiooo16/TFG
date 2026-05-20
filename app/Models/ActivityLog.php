<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table      = 'activity_log';
    public $timestamps    = false;
    protected $fillable   = ['usuario','accion','modelo','detalle'];

    public static function log(string $accion, string $modelo, string $detalle = ''): void
    {
        static::create([
            'usuario' => auth()->user()?->name ?? 'Sistema',
            'accion'  => $accion,
            'modelo'  => $modelo,
            'detalle' => $detalle,
        ]);
    }
}
