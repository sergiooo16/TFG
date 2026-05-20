<!DOCTYPE html><html lang="es"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>{{ $rumor?'Editar':'Añadir' }} Rumor – Admin F1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>*{box-sizing:border-box;margin:0;padding:0;}body{background:#f3f4f6;font-family:'Barlow',sans-serif;color:#111;}.adm-link{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;}.adm-link:hover{background:#f9fafb;color:#111;}.adm-active{background:#fff1f2;color:#E8002D !important;border-left:3px solid #E8002D;padding-left:7px;}.f1-input{width:100%;background:#fff;border:1px solid #d1d5db;color:#111;border-radius:8px;padding:10px 14px;font-family:'Barlow',sans-serif;font-size:.9rem;outline:none;transition:border-color .25s;}.f1-input:focus{border-color:#E8002D;box-shadow:0 0 0 3px rgba(232,0,45,.08);}.f1-label{font-family:'Barlow Condensed';font-weight:600;font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:#6b7280;display:block;margin-bottom:6px;}.btn-red{background:#E8002D;color:#fff;font-family:'Barlow Condensed';font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-size:.85rem;transition:background .2s;}.btn-red:hover{background:#c70027;}.btn-outline{font-family:'Barlow Condensed';font-weight:700;font-size:.8rem;letter-spacing:.1em;text-transform:uppercase;color:#6b7280;border:1px solid #d1d5db;padding:10px 20px;border-radius:8px;text-decoration:none;transition:all .2s;display:inline-block;}.btn-outline:hover{color:#111;border-color:#6b7280;}.alert-err{padding:12px 16px;background:#fff1f2;border:1px solid #fecdd3;border-radius:8px;color:#E8002D;font-family:'Barlow';font-size:.85rem;margin-bottom:20px;}</style>
</head>
<body>
<div style="display:flex;min-height:100vh;">
  @include('admin.sidebar')
  <main style="flex:1;padding:32px;">
    <div style="margin-bottom:28px;">
      <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#E8002D;margin-bottom:4px;">{{ $rumor?'Editar':'Nuevo' }}</div>
      <h1 style="font-family:'Barlow Condensed';font-weight:800;font-size:2rem;color:#111;">{{ $rumor?$rumor->piloto.' → '.$rumor->equipo:'Añadir Rumor' }}</h1>
    </div>
    @if($errors->any())<div class="alert-err">@foreach($errors->all() as $e)<div>· {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="{{ $rumor?route('admin.rumores.update',$rumor->id):route('admin.rumores.store') }}" style="max-width:680px;">
      @csrf @if($rumor) @method('PUT') @endif
      <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;margin-bottom:20px;">
        <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.8rem;letter-spacing:.12em;text-transform:uppercase;color:#111;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid #f3f4f6;">Datos del Rumor</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
          <div><label class="f1-label">Piloto</label><input type="text" name="piloto" class="f1-input" value="{{ old('piloto',$rumor?->piloto) }}" required placeholder="Max Verstappen"></div>
          <div><label class="f1-label">Equipo destino</label><input type="text" name="equipo" class="f1-input" value="{{ old('equipo',$rumor?->equipo) }}" required placeholder="Mercedes"></div>
          <div><label class="f1-label">Color del equipo (hex)</label><input type="text" name="color" class="f1-input" value="{{ old('color',$rumor?->color??'#E8002D') }}" placeholder="#00D2BE"></div>
          <div><label class="f1-label">Credibilidad (%)</label><input type="number" name="credibilidad" class="f1-input" value="{{ old('credibilidad',$rumor?->credibilidad??50) }}" min="0" max="100" required></div>
          <div style="grid-column:1/-1"><label class="f1-label">Tag (ej: 🔴 Muy probable)</label><input type="text" name="tag" class="f1-input" value="{{ old('tag',$rumor?->tag) }}" required placeholder="🔴 Muy probable"></div>
          <div style="grid-column:1/-1"><label class="f1-label">Texto del rumor</label><textarea name="texto" class="f1-input" rows="3" required placeholder="Texto del rumor...">{{ old('texto',$rumor?->texto) }}</textarea></div>
          <div><label class="f1-label">Fuente</label><input type="text" name="fuente" class="f1-input" value="{{ old('fuente',$rumor?->fuente) }}" required placeholder="The Race"></div>
          <div><label class="f1-label">Fecha</label><input type="text" name="fecha" class="f1-input" value="{{ old('fecha',$rumor?->fecha) }}" required placeholder="17 May 2026"></div>
        </div>
      </div>
      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-red">{{ $rumor?'Guardar Cambios':'Crear Rumor' }}</button>
        <a href="{{ route('admin.rumores') }}" class="btn-outline">Cancelar</a>
      </div>
    </form>
  </main>
</div>
</body>
</html>
