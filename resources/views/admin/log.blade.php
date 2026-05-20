<!DOCTYPE html><html lang="es"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Log – Admin F1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>*{box-sizing:border-box;margin:0;padding:0;}body{background:#f3f4f6;font-family:'Barlow',sans-serif;color:#111;}.adm-link{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;}.adm-link:hover{background:#f9fafb;color:#111;}.adm-active{background:#fff1f2;color:#E8002D !important;border-left:3px solid #E8002D;padding-left:7px;}</style>
</head>
<body>
<div style="display:flex;min-height:100vh;">
  @include('admin.sidebar')
  <main style="flex:1;padding:32px;overflow:auto;">
    <div style="margin-bottom:28px;">
      <div style="font-family:'Barlow Condensed';font-weight:700;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#E8002D;margin-bottom:4px;">Historial</div>
      <h1 style="font-family:'Barlow Condensed';font-weight:800;font-size:2rem;color:#111;">Log de Actividad</h1>
    </div>
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;">
      <table style="width:100%;border-collapse:collapse;">
        <thead style="background:#f9fafb;"><tr>
          <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Acción</th>
          <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Sección</th>
          <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Detalle</th>
          <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Usuario</th>
          <th style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:#9ca3af;text-align:left;padding:12px 16px;font-weight:600;">Fecha</th>
        </tr></thead>
        <tbody>
          @forelse($logs as $log)
          <tr style="border-top:1px solid #f3f4f6;transition:background .15s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='#fff'">
            <td style="padding:14px 16px;">
              @if($log->accion==='Crear')<span style="background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;">Crear</span>
              @elseif($log->accion==='Eliminar')<span style="background:#fff1f2;color:#E8002D;border:1px solid #fecdd3;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;">Eliminar</span>
              @else<span style="background:#eff6ff;color:#3b82f6;border:1px solid #bfdbfe;font-family:'Barlow Condensed';font-weight:700;font-size:.6rem;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:20px;">{{ $log->accion }}</span>@endif
            </td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#6b7280;font-size:.875rem;">{{ $log->modelo }}</td>
            <td style="padding:14px 16px;font-family:'Barlow';font-weight:600;color:#111;font-size:.875rem;">{{ $log->detalle }}</td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#6b7280;font-size:.82rem;">{{ $log->usuario }}</td>
            <td style="padding:14px 16px;font-family:'Barlow';color:#9ca3af;font-size:.78rem;">{{ $log->created_at }}</td>
          </tr>
          @empty
          <tr><td colspan="5" style="padding:40px;text-align:center;font-family:'Barlow';color:#9ca3af;">Sin actividad registrada.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div style="margin-top:20px;">{{ $logs->links() }}</div>
  </main>
</div>
</body>
</html>
