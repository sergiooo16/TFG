<!DOCTYPE html><html lang="es"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>{{ $circuito?'Editar':'Añadir' }} Circuito – Admin F1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}body{background:#f3f4f6;font-family:'Barlow',sans-serif;color:#111;}
    .adm-link{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;}.adm-link:hover{background:#f9fafb;color:#111;}.adm-active{background:#fff1f2;color:#E8002D !important;border-left:3px solid #E8002D;padding-left:7px;}
    .f1-input{width:100%;background:#fff;border:1px solid #d1d5db;color:#111;border-radius:8px;padding:10px 14px;font-family:'Barlow',sans-serif;font-size:.9rem;outline:none;transition:border-color .25s;}.f1-input:focus{border-color:#E8002D;box-shadow:0 0 0 3px rgba(232,0,45,.08);}
    .f1-label{font-family:'Barlow Condensed';font-weight:600;font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:#6b7280;display:block;margin-bottom:6px;}
    .btn-red{background:#E8002D;color:#fff;font-family:'Barlow Condensed';font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-size:.85rem;transition:background .2s;}.btn-red:hover{background:#c70027;}
    .btn-outline{font-family:'Barlow Condensed';font-weight:700;font-size:.8rem;letter-spacing:.1em;text-transform:uppercase;color:#6b7280;border:1px solid #d1d5db;padding:10px 20px;border-radius:8px;text-decoration:none;transition:all .2s;display:inline-block;}.btn-outline:hover{color:#111;border-color:#6b7280;}
    .section-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;margin-bottom:20px;}
    .section-title{font-family:'Barlow Condensed';font-weight:700;font-size:.8rem;letter-spacing:.12em;text-transform:uppercase;color:#111;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid #f3f4f6;}
    .alert-err{padding:12px 16px;background:#fff1f2;border:1px solid #fecdd3;border-radius:8px;color:#E8002D;font-family:'Barlow';font-size:.85rem;margin-bottom:20px;}
  </style>
</head>
<body>
<div style="display:flex;min-height:100vh;">
  @include('admin.sidebar')
  <main style="flex:1;padding:32px;overflow:auto;max-width:900px;">
    <div style="margin-bottom:28px;">
      <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#E8002D;margin-bottom:4px;">{{ $circuito?'Editar':'Nuevo' }}</div>
      <h1 style="font-family:'Barlow Condensed';font-weight:800;font-size:2rem;color:#111;">{{ $circuito?$circuito->nombre:'Añadir Circuito' }}</h1>
    </div>
    @if($errors->any())<div class="alert-err">@foreach($errors->all() as $e)<div>· {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="{{ $circuito?route('admin.circuitos.update',$circuito->id):route('admin.circuitos.store') }}">
      @csrf @if($circuito) @method('PUT') @endif
      <div class="section-card">
        <div class="section-title">Información del circuito</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
          @if(!$circuito)<div><label class="f1-label">ID (ej: aus, mon)</label><input type="text" name="id" class="f1-input" value="{{ old('id') }}" maxlength="5" required placeholder="aus"></div>@endif
          <div><label class="f1-label">Ronda</label><input type="number" name="ronda" class="f1-input" value="{{ old('ronda',$circuito?->ronda) }}" required></div>
          <div style="grid-column:1/-1"><label class="f1-label">Nombre completo</label><input type="text" name="nombre" class="f1-input" value="{{ old('nombre',$circuito?->nombre) }}" required placeholder="Gran Premio de Australia"></div>
          <div><label class="f1-label">Nombre corto</label><input type="text" name="short" class="f1-input" value="{{ old('short',$circuito?->short) }}" required placeholder="Australia"></div>
          <div><label class="f1-label">Nombre del circuito</label><input type="text" name="circuito" class="f1-input" value="{{ old('circuito',$circuito?->circuito) }}" required placeholder="Albert Park Circuit"></div>
          <div><label class="f1-label">Ciudad</label><input type="text" name="ciudad" class="f1-input" value="{{ old('ciudad',$circuito?->ciudad) }}" required placeholder="Melbourne"></div>
          <div><label class="f1-label">Bandera (emoji)</label><input type="text" name="flag" class="f1-input" value="{{ old('flag',$circuito?->flag) }}" required placeholder="🇦🇺"></div>
          <div><label class="f1-label">Fecha</label><input type="text" name="fecha" class="f1-input" value="{{ old('fecha',$circuito?->fecha) }}" required placeholder="6–8 Mar"></div>
          <div>
            <label class="f1-label">Estado</label>
            <select name="estado" class="f1-input" required>
              <option value="done" {{ old('estado',$circuito?->estado)==='done'?'selected':'' }}>Finalizado</option>
              <option value="next" {{ old('estado',$circuito?->estado)==='next'?'selected':'' }}>Próxima carrera</option>
              <option value="upcoming" {{ old('estado',$circuito?->estado)==='upcoming'?'selected':'' }}>Próximamente</option>
            </select>
          </div>
          <div style="display:flex;align-items:center;gap:10px;padding:12px;background:#f9fafb;border-radius:8px;border:1px solid #e5e7eb;align-self:end;">
            <input type="checkbox" name="sprint" id="sprint" value="1" {{ old('sprint',$circuito?->sprint)?'checked':'' }} style="width:16px;height:16px;accent-color:#E8002D;cursor:pointer;">
            <label for="sprint" class="f1-label" style="margin:0;cursor:pointer;color:#111;">¿Carrera Sprint?</label>
          </div>
          <div style="grid-column:1/-1"><label class="f1-label">Imagen (ruta: circuits/australia.jpg)</label><input type="text" name="imagen" class="f1-input" value="{{ old('imagen',$circuito?->imagen) }}" required placeholder="circuits/australia.jpg"></div>
        </div>
      </div>
      <div class="section-card">
        <div class="section-title">Precios de entradas (€)</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
          <div><label class="f1-label">🏁 General (GA)</label><input type="number" name="precio_ga" class="f1-input" value="{{ old('precio_ga',$circuito?->precio_ga) }}" placeholder="149"></div>
          <div><label class="f1-label">💺 Grandstand</label><input type="number" name="precio_grand" class="f1-input" value="{{ old('precio_grand',$circuito?->precio_grand) }}" placeholder="349"></div>
          <div><label class="f1-label">⭐ VIP Club</label><input type="number" name="precio_vip" class="f1-input" value="{{ old('precio_vip',$circuito?->precio_vip) }}" placeholder="1299"></div>
          <div><label class="f1-label">🏆 Paddock Club</label><input type="number" name="precio_paddock" class="f1-input" value="{{ old('precio_paddock',$circuito?->precio_paddock) }}" placeholder="2999"></div>
        </div>
      </div>
      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-red">{{ $circuito?'Guardar Cambios':'Crear Circuito' }}</button>
        <a href="{{ route('admin.circuitos') }}" class="btn-outline">Cancelar</a>
      </div>
    </form>
  </main>
</div>
</body>
</html>
