<!DOCTYPE html><html lang="es"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>{{ $noticia?'Editar':'Añadir' }} Noticia – Admin F1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>*{box-sizing:border-box;margin:0;padding:0;}body{background:#f3f4f6;font-family:'Barlow',sans-serif;color:#111;}.adm-link{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;}.adm-link:hover{background:#f9fafb;color:#111;}.adm-active{background:#fff1f2;color:#E8002D !important;border-left:3px solid #E8002D;padding-left:7px;}.f1-input{width:100%;background:#fff;border:1px solid #d1d5db;color:#111;border-radius:8px;padding:10px 14px;font-family:'Barlow',sans-serif;font-size:.9rem;outline:none;transition:border-color .25s;}.f1-input:focus{border-color:#E8002D;box-shadow:0 0 0 3px rgba(232,0,45,.08);}.f1-label{font-family:'Barlow Condensed';font-weight:600;font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:#6b7280;display:block;margin-bottom:6px;}.btn-red{background:#E8002D;color:#fff;font-family:'Barlow Condensed';font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-size:.85rem;transition:background .2s;}.btn-red:hover{background:#c70027;}.btn-outline{font-family:'Barlow Condensed';font-weight:700;font-size:.8rem;letter-spacing:.1em;text-transform:uppercase;color:#6b7280;border:1px solid #d1d5db;padding:10px 20px;border-radius:8px;text-decoration:none;transition:all .2s;display:inline-block;}.btn-outline:hover{color:#111;border-color:#6b7280;}.alert-err{padding:12px 16px;background:#fff1f2;border:1px solid #fecdd3;border-radius:8px;color:#E8002D;font-family:'Barlow';font-size:.85rem;margin-bottom:20px;}</style>
</head>
<body>
<div style="display:flex;min-height:100vh;">
  @include('admin.sidebar')
  <main style="flex:1;padding:32px;">
    <div style="margin-bottom:28px;">
      <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#E8002D;margin-bottom:4px;">{{ $noticia?'Editar':'Nueva' }}</div>
      <h1 style="font-family:'Barlow Condensed';font-weight:800;font-size:2rem;color:#111;">{{ $noticia?'Editar Noticia':'Añadir Noticia' }}</h1>
    </div>
    @if($errors->any())<div class="alert-err">@foreach($errors->all() as $e)<div>· {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="{{ $noticia?route('admin.noticias.update',$noticia->id):route('admin.noticias.store') }}" style="max-width:680px;">
      @csrf @if($noticia) @method('PUT') @endif
      <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;margin-bottom:20px;">
        <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.8rem;letter-spacing:.12em;text-transform:uppercase;color:#111;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid #f3f4f6;">Datos de la Noticia</div>
        <div style="display:flex;flex-direction:column;gap:16px;">
          <div><label class="f1-label">Título</label><input type="text" name="titulo" class="f1-input" value="{{ old('titulo',$noticia?->titulo) }}" required placeholder="Título de la noticia"></div>
          <div><label class="f1-label">Extracto / Resumen</label><textarea name="extracto" class="f1-input" rows="4" required placeholder="Resumen de la noticia...">{{ old('extracto',$noticia?->extracto) }}</textarea></div>
          <div><label class="f1-label">URL imagen (opcional)</label><input type="text" name="imagen" class="f1-input" value="{{ old('imagen',$noticia?->imagen) }}" placeholder="https://..."></div>
          <div><label class="f1-label">URL enlace (opcional)</label><input type="text" name="url" class="f1-input" value="{{ old('url',$noticia?->url??'#') }}" placeholder="https://motorsport.com/..."></div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div><label class="f1-label">Fuente</label><input type="text" name="fuente" class="f1-input" value="{{ old('fuente',$noticia?->fuente??'F1 Admin') }}" required placeholder="F1 Admin"></div>
            <div><label class="f1-label">Fecha</label><input type="text" name="fecha" class="f1-input" value="{{ old('fecha',$noticia?->fecha) }}" required placeholder="17 May 2026"></div>
          </div>
        </div>
      </div>
      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-red">{{ $noticia?'Guardar Cambios':'Crear Noticia' }}</button>
        <a href="{{ route('admin.noticias') }}" class="btn-outline">Cancelar</a>
      </div>
    </form>
  </main>
</div>
</body>
</html>
