<!DOCTYPE html><html lang="es"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Circuitos – Admin F1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}body{background:#f3f4f6;font-family:'Barlow',sans-serif;color:#111;}
    .adm-link{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;}.adm-link:hover{background:#f9fafb;color:#111;}.adm-active{background:#fff1f2;color:#E8002D !important;border-left:3px solid #E8002D;padding-left:7px;}
    .btn-red{background:#E8002D;color:#fff;font-family:'Barlow Condensed';font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:9px 20px;border-radius:8px;border:none;cursor:pointer;font-size:.82rem;text-decoration:none;display:inline-block;transition:background .2s;}.btn-red:hover{background:#c70027;}
    .btn-outline{font-family:'Barlow Condensed';font-weight:700;font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:#6b7280;border:1px solid #d1d5db;padding:6px 14px;border-radius:6px;text-decoration:none;transition:all .2s;display:inline-block;}.btn-outline:hover{color:#111;border-color:#6b7280;}
    .btn-danger{font-family:'Barlow Condensed';font-weight:700;font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:#E8002D;border:1px solid #fecdd3;padding:6px 14px;border-radius:6px;background:#fff;cursor:pointer;transition:all .2s;}.btn-danger:hover{background:#fff1f2;}
    .alert-ok{padding:12px 16px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;color:#16a34a;font-family:'Barlow Condensed';font-weight:600;font-size:.85rem;letter-spacing:.05em;margin-bottom:20px;}
  </style>
</head>
<body>
<div style="display:flex;min-height:100vh;">
  @include('admin.sidebar')
  <main style="flex:1;padding:32px;overflow:auto;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;">
      <div>
        <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#E8002D;margin-bottom:4px;">Gestión</div>
        <h1 style="font-family:'Barlow Condensed';font-weight:800;font-size:2rem;color:#111;">Circuitos</h1>
      </div>
      <a href="{{ route('admin.circuitos.create') }}" class="btn-red">+ Añadir Circuito</a>
    </div>
    @if(session('ok'))<div class="alert-ok">✓ {{ session('ok') }}</div>@endif
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;">
      <table style="width:100%;border-collapse:collapse;">
        <thead style="background:#f9fafb;">
          <tr>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">R</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Gran Premio</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Fecha</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Estado</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">GA</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Grand</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">VIP</th>
            <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:right;padding:12px 16px;font-weight:600;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($circuitos as $c)
          <tr style="border-top:1px solid #f3f4f6;transition:background .15s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='#fff'">
            <td style="padding:14px 16px;font-family:'Barlow Condensed';font-weight:700;color:#9ca3af;font-size:.85rem;">{{ $c->ronda }}</td>
            <td style="padding:14px 16px;">
              <div style="font-family:'Barlow';font-weight:600;color:#111;font-size:.9rem;">{{ $c->flag }} {{ $c->nombre }}</div>
              <div style="font-family:'Barlow';font-size:.75rem;color:#9ca3af;margin-top:2px;">{{ $c->circuito }}</div>
            </td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#6b7280;font-size:.85rem;">{{ $c->fecha }}</td>
            <td style="padding:14px 16px;">
              @if($c->estado==='done')<span style="background:#f3f4f6;color:#6b7280;border:1px solid #e5e7eb;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;">Finalizado</span>
              @elseif($c->estado==='next')<span style="background:#fff1f2;color:#E8002D;border:1px solid #fecdd3;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;">● Próxima</span>
              @else<span style="background:#fffbeb;color:#d97706;border:1px solid #fde68a;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;">Próximamente</span>@endif
            </td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#374151;font-size:.875rem;">€{{ $c->precio_ga }}</td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#374151;font-size:.875rem;">€{{ $c->precio_grand }}</td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#374151;font-size:.875rem;">€{{ $c->precio_vip }}</td>
            <td style="padding:14px 16px;text-align:right;">
              <div style="display:flex;align-items:center;justify-content:flex-end;gap:8px;">
                <a href="{{ route('admin.circuitos.edit',$c->id) }}" class="btn-outline">Editar</a>
                <form method="POST" action="{{ route('admin.circuitos.destroy',$c->id) }}" onsubmit="return confirm('¿Eliminar {{ $c->short }}?')" style="margin:0;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-danger">Borrar</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>
</div>
</body>
</html>
