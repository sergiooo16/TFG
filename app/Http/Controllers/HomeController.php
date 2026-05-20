<?php

namespace App\Http\Controllers;

use App\Models\ImagenCircuito;

class HomeController extends Controller
{
    public function index()
    {
        $circuitosData = ImagenCircuito::orderBy('ronda')
            ->get()
            ->map(function ($c) {
                return [
                    'id'      => $c->id,
                    'r'       => $c->ronda,
                    'name'    => $c->nombre,
                    'short'   => $c->short,
                    'circuit' => $c->circuito,
                    'city'    => $c->ciudad,
                    'flag'    => $c->flag,
                    'date'    => $c->fecha,
                    'st'      => $c->estado,
                    'sprint'  => (bool) $c->sprint,
                    'img'     => asset('asstes/' . $c->imagen),
                    't'       => [
                        'ga'    => $c->precio_ga,
                        'grand' => $c->precio_grand,
                        'vip'   => $c->precio_vip,
                        'p'     => $c->precio_paddock,
                    ],
                ];
            })
            ->values();

        return view('home', compact('circuitosData'));


    }
}
