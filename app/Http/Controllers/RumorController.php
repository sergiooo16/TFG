<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Rumor;

class RumorController extends Controller
{
    public function index(): JsonResponse
    {
        $rumores = Rumor::where('activo', 1)
            ->orderByDesc('id')
            ->get()
            ->map(fn($r) => [
                'driver'     => $r->piloto,
                'team'       => $r->equipo,
                'color'      => $r->color,
                'tag'        => $r->tag,
                'cred'       => (int) $r->credibilidad,
                'credColor'  => $this->credColor((int) $r->credibilidad),
                'tagCls'     => $this->tagCls($r->tag),
                'text'       => $r->texto,
                'source'     => $r->fuente,
                'date'       => $r->fecha,
            ]);

        return response()->json($rumores);
    }

    private function credColor(int $cred): string
    {
        if ($cred >= 75) return '#E8002D';
        if ($cred >= 50) return '#FF8C00';
        return '#FFD700';
    }

    private function tagCls(string $tag): string
    {
        if (str_contains($tag, '🔴')) return 'bg-red-500/15 text-red-400 border border-red-500/30';
        if (str_contains($tag, '🟠')) return 'bg-orange-500/15 text-orange-400 border border-orange-500/30';
        if (str_contains($tag, '🟡')) return 'bg-yellow-500/15 text-yellow-400 border border-yellow-500/30';
        if (str_contains($tag, '🟢')) return 'bg-green-500/15 text-green-400 border border-green-500/30';
        return 'bg-gray-500/15 text-gray-400 border border-gray-500/30';
    }
}
