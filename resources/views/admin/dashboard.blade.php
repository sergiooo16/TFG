<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard – Admin F1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{background:#f3f4f6;font-family:'Barlow',sans-serif;color:#111;}
    .card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;}
    .card-title{font-family:'Barlow Condensed';font-weight:700;font-size:.75rem;letter-spacing:.15em;text-transform:uppercase;color:#6b7280;margin-bottom:16px;}
    .badge-red{background:#fff1f2;color:#E8002D;border:1px solid #fecdd3;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;}
    .badge-gray{background:#f9fafb;color:#6b7280;border:1px solid #e5e7eb;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;}
    .badge-green{background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;}
    .f1-select{background:#fff;border:1px solid #d1d5db;color:#111;border-radius:8px;padding:9px 12px;font-family:'Barlow',sans-serif;font-size:.875rem;outline:none;transition:border-color .2s;}
    .f1-select:focus{border-color:#E8002D;box-shadow:0 0 0 3px rgba(232,0,45,.08);}
    .btn-red{background:#E8002D;color:#fff;font-family:'Barlow Condensed';font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:9px 20px;border-radius:8px;border:none;cursor:pointer;font-size:.82rem;transition:background .2s;}
    .btn-red:hover{background:#c70027;}
  </style>
</head>
<body>
<div style="display:flex;min-height:100vh;">
  @include('admin.sidebar')
  <main style="flex:1;padding:32px;overflow:auto;">

    <div style="margin-bottom:28px;display:flex;align-items:center;justify-content:between;">
      <div>
        <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#E8002D;margin-bottom:4px;">Panel de Control</div>
        <h1 style="font-family:'Barlow Condensed';font-weight:800;font-size:2rem;color:#111;letter-spacing:.01em;">Dashboard</h1>
      </div>
    </div>

    @if(session('ok'))
      <div style="margin-bottom:20px;padding:12px 16px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;color:#16a34a;font-family:'Barlow Condensed';font-weight:600;font-size:.85rem;letter-spacing:.05em;">✓ {{ session('ok') }}</div>
    @endif

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
      <div class="card" style="border-top:3px solid #E8002D;">
        <div style="font-family:'Barlow Condensed';font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;margin-bottom:8px;">Usuarios</div>
        <div style="font-family:'Barlow Condensed';font-weight:800;font-size:2.5rem;color:#111;line-height:1;">{{ $stats['total_usuarios'] }}</div>
      </div>
      <div class="card" style="border-top:3px solid #111;">
        <div style="font-family:'Barlow Condensed';font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;margin-bottom:8px;">Circuitos</div>
        <div style="font-family:'Barlow Condensed';font-weight:800;font-size:2.5rem;color:#111;line-height:1;">{{ $stats['total_circuitos'] }}</div>
      </div>
      <div class="card" style="border-top:3px solid #f59e0b;">
        <div style="font-family:'Barlow Condensed';font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;margin-bottom:8px;">Rumores</div>
        <div style="font-family:'Barlow Condensed';font-weight:800;font-size:2.5rem;color:#111;line-height:1;">{{ $stats['total_rumores'] }}</div>
      </div>
      <div class="card" style="border-top:3px solid #3b82f6;">
        <div style="font-family:'Barlow Condensed';font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;margin-bottom:8px;">Noticias</div>
        <div style="font-family:'Barlow Condensed';font-weight:800;font-size:2.5rem;color:#111;line-height:1;">{{ $stats['total_noticias'] }}</div>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">

      <div class="card">
        <div class="card-title">🏁 Cambiar Próxima Carrera</div>
        @if($stats['proxima_carrera'])
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;padding:10px 12px;background:#fff1f2;border-radius:8px;border:1px solid #fecdd3;">
            <span style="font-size:1.1rem;">{{ $stats['proxima_carrera']->flag }}</span>
            <div>
              <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.85rem;color:#E8002D;">Actual: {{ $stats['proxima_carrera']->nombre }}</div>
              <div style="font-family:'Barlow';font-size:.75rem;color:#9ca3af;">{{ $stats['proxima_carrera']->fecha }}</div>
            </div>
          </div>
        @endif
        <form method="POST" action="{{ route('admin.setNextRace') }}" style="display:flex;gap:10px;">
          @csrf
          <select name="circuito_id" class="f1-select" style="flex:1;">
            @foreach($circuitos as $c)
              <option value="{{ $c->id }}" {{ $stats['proxima_carrera']?->id===$c->id ? 'selected' : '' }}>R{{ $c->ronda }} · {{ $c->flag }} {{ $c->short }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn-red">Establecer</button>
        </form>
      </div>

      <div class="card">
        <div class="card-title">📈 Registros últimos 7 días</div>
        <canvas id="usersChart" height="120"></canvas>
      </div>

    </div>

    <div class="card">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <div class="card-title" style="margin:0;">📋 Actividad reciente</div>
        <a href="{{ route('admin.log') }}" style="font-family:'Barlow Condensed';font-weight:600;font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:#E8002D;text-decoration:none;">Ver todo →</a>
      </div>
      @forelse($logs as $log)
        <div style="display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f3f4f6;">
          <div style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;{{ $log->accion==='Crear' ? 'background:#f0fdf4;' : ($log->accion==='Eliminar' ? 'background:#fff1f2;' : 'background:#eff6ff;') }}">
            {{ $log->accion==='Crear' ? '➕' : ($log->accion==='Eliminar' ? '🗑️' : '✏️') }}
          </div>
          <div style="flex:1;">
            <div style="font-family:'Barlow';font-weight:600;color:#111;font-size:.88rem;"><span style="color:#E8002D;">{{ $log->accion }}</span> {{ $log->modelo }}: {{ $log->detalle }}</div>
            <div style="font-family:'Barlow';font-size:.75rem;color:#9ca3af;margin-top:2px;">{{ $log->usuario }} · {{ $log->created_at }}</div>
          </div>
        </div>
      @empty
        <div style="font-family:'Barlow';color:#9ca3af;font-size:.875rem;padding:16px 0;">Sin actividad registrada aún.</div>
      @endforelse
    </div>

  </main>
</div>

<script>
const dias   = @json($usuariosPorDia->pluck('dia'));
const totals = @json($usuariosPorDia->pluck('total'));
new Chart(document.getElementById('usersChart'),{
  type:'bar',
  data:{labels:dias,datasets:[{label:'Registros',data:totals,backgroundColor:'rgba(232,0,45,.15)',borderColor:'#E8002D',borderWidth:2,borderRadius:6}]},
  options:{plugins:{legend:{display:false}},scales:{x:{ticks:{color:'#9ca3af',font:{size:11}},grid:{display:false}},y:{ticks:{color:'#9ca3af',font:{size:11},stepSize:1},grid:{color:'#f3f4f6'}}}}
});
</script>
</body>
</html>
