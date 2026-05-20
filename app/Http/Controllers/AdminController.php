<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImagenCircuito;
use App\Models\User;
use App\Models\Rumor;
use App\Models\Noticia;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_usuarios'     => User::count(),
            'total_circuitos'    => ImagenCircuito::count(),
            'circuitos_done'     => ImagenCircuito::where('estado', 'done')->count(),
            'circuitos_next'     => ImagenCircuito::where('estado', 'next')->count(),
            'circuitos_upcoming' => ImagenCircuito::where('estado', 'upcoming')->count(),
            'proxima_carrera'    => ImagenCircuito::where('estado', 'next')->first(),
            'total_rumores'      => Rumor::count(),
            'total_noticias'     => Noticia::count(),
        ];
        $logs          = ActivityLog::orderByDesc('id')->limit(10)->get();
        $circuitos     = ImagenCircuito::orderBy('ronda')->get();
        $usuariosPorDia = User::selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('dia')->orderBy('dia')->get();
        return view('admin.dashboard', compact('stats','logs','circuitos','usuariosPorDia'));
    }

    public function setNextRace(Request $request)
    {
        $request->validate(['circuito_id' => 'required|exists:imagenescircuitos,id']);
        ImagenCircuito::where('estado','next')->update(['estado'=>'upcoming']);
        ImagenCircuito::where('id',$request->circuito_id)->update(['estado'=>'next']);
        ActivityLog::log('Cambio próxima carrera','Circuito',$request->circuito_id);
        return redirect()->route('admin.dashboard')->with('ok','Próxima carrera actualizada.');
    }

    public function circuitos()
    {
        $circuitos = ImagenCircuito::orderBy('ronda')->get();
        return view('admin.circuitos', compact('circuitos'));
    }

    public function circuitoCreate() { return view('admin.circuito-form',['circuito'=>null]); }

    public function circuitoStore(Request $request)
    {
        $request->validate(['id'=>'required|max:5|unique:imagenescircuitos,id','ronda'=>'required|integer','nombre'=>'required|max:100','short'=>'required|max:30','circuito'=>'required|max:100','ciudad'=>'required|max:50','flag'=>'required|max:10','fecha'=>'required|max:20','estado'=>'required|in:done,next,upcoming','imagen'=>'required|max:255']);
        $data = $request->all(); $data['sprint'] = $request->has('sprint') ? 1 : 0;
        ImagenCircuito::create($data);
        ActivityLog::log('Crear','Circuito',$request->nombre);
        return redirect()->route('admin.circuitos')->with('ok','Circuito añadido.');
    }

    public function circuitoEdit($id) { return view('admin.circuito-form',['circuito'=>ImagenCircuito::findOrFail($id)]); }

    public function circuitoUpdate(Request $request, $id)
    {
        $c = ImagenCircuito::findOrFail($id);
        $request->validate(['ronda'=>'required|integer','nombre'=>'required|max:100','short'=>'required|max:30','circuito'=>'required|max:100','ciudad'=>'required|max:50','flag'=>'required|max:10','fecha'=>'required|max:20','estado'=>'required|in:done,next,upcoming','imagen'=>'required|max:255','precio_ga'=>'required|integer','precio_grand'=>'required|integer','precio_vip'=>'required|integer','precio_paddock'=>'required|integer']);
        $c->update(array_merge($request->except('_token','_method','id'),['sprint'=>$request->has('sprint')?1:0]));
        ActivityLog::log('Editar','Circuito',$request->nombre);
        return redirect()->route('admin.circuitos')->with('ok','Circuito actualizado.');
    }

    public function circuitoDestroy($id) { $c=ImagenCircuito::findOrFail($id); ActivityLog::log('Eliminar','Circuito',$c->nombre); $c->delete(); return redirect()->route('admin.circuitos')->with('ok','Circuito eliminado.'); }

    public function usuarios() { return view('admin.usuarios',['usuarios'=>User::orderBy('created_at','desc')->get()]); }
    public function usuarioEdit($id) { return view('admin.usuario-form',['usuario'=>User::findOrFail($id)]); }

    public function usuarioUpdate(Request $request, $id)
    {
        $u=User::findOrFail($id);
        $request->validate(['name'=>'required|max:255','email'=>'required|email|unique:users,email,'.$id]);
        $u->update(['name'=>$request->name,'email'=>$request->email,'is_admin'=>$request->has('is_admin')?1:0]);
        ActivityLog::log('Editar','Usuario',$request->name);
        return redirect()->route('admin.usuarios')->with('ok','Usuario actualizado.');
    }

    public function usuarioDestroy($id)
    {
        if($id==auth()->id()) return redirect()->route('admin.usuarios')->with('error','No puedes eliminarte a ti mismo.');
        $u=User::findOrFail($id); ActivityLog::log('Eliminar','Usuario',$u->name); $u->delete();
        return redirect()->route('admin.usuarios')->with('ok','Usuario eliminado.');
    }

    public function rumores() { return view('admin.rumores',['rumores'=>Rumor::orderByDesc('id')->get()]); }
    public function rumorCreate() { return view('admin.rumor-form',['rumor'=>null]); }

    public function rumorStore(Request $request)
    {
        $request->validate(['piloto'=>'required|max:100','equipo'=>'required|max:100','tag'=>'required|max:50','credibilidad'=>'required|integer|min:0|max:100','texto'=>'required','fuente'=>'required|max:100','fecha'=>'required|max:20']);
        Rumor::create($request->all());
        ActivityLog::log('Crear','Rumor',$request->piloto.' → '.$request->equipo);
        return redirect()->route('admin.rumores')->with('ok','Rumor añadido.');
    }

    public function rumorEdit($id) { return view('admin.rumor-form',['rumor'=>Rumor::findOrFail($id)]); }

    public function rumorUpdate(Request $request, $id)
    {
        $r=Rumor::findOrFail($id);
        $request->validate(['piloto'=>'required|max:100','equipo'=>'required|max:100','tag'=>'required|max:50','credibilidad'=>'required|integer|min:0|max:100','texto'=>'required','fuente'=>'required|max:100','fecha'=>'required|max:20']);
        $r->update($request->all());
        ActivityLog::log('Editar','Rumor',$request->piloto);
        return redirect()->route('admin.rumores')->with('ok','Rumor actualizado.');
    }

    public function rumorDestroy($id) { $r=Rumor::findOrFail($id); ActivityLog::log('Eliminar','Rumor',$r->piloto); $r->delete(); return redirect()->route('admin.rumores')->with('ok','Rumor eliminado.'); }

    public function noticias() { return view('admin.noticias',['noticias'=>Noticia::orderByDesc('id')->get()]); }
    public function noticiaCreate() { return view('admin.noticia-form',['noticia'=>null]); }

    public function noticiaStore(Request $request)
    {
        $request->validate(['titulo'=>'required|max:255','extracto'=>'required','fuente'=>'required|max:100','fecha'=>'required|max:20']);
        Noticia::create($request->all());
        ActivityLog::log('Crear','Noticia',$request->titulo);
        return redirect()->route('admin.noticias')->with('ok','Noticia añadida.');
    }

    public function noticiaEdit($id) { return view('admin.noticia-form',['noticia'=>Noticia::findOrFail($id)]); }

    public function noticiaUpdate(Request $request, $id)
    {
        $n=Noticia::findOrFail($id);
        $request->validate(['titulo'=>'required|max:255','extracto'=>'required','fuente'=>'required|max:100','fecha'=>'required|max:20']);
        $n->update($request->all());
        ActivityLog::log('Editar','Noticia',$request->titulo);
        return redirect()->route('admin.noticias')->with('ok','Noticia actualizada.');
    }

    public function noticiaDestroy($id) { $n=Noticia::findOrFail($id); ActivityLog::log('Eliminar','Noticia',$n->titulo); $n->delete(); return redirect()->route('admin.noticias')->with('ok','Noticia eliminada.'); }

    public function log() { return view('admin.log',['logs'=>ActivityLog::orderByDesc('id')->paginate(30)]); }
}
