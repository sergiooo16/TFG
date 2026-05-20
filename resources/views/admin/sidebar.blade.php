<aside style="width:240px;min-height:100vh;background:#fff;border-right:1px solid #e5e7eb;padding:0;display:flex;flex-direction:column;">

  <div style="padding:24px 20px;border-bottom:1px solid #f3f4f6;">
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:36px;height:36px;background:#E8002D;border-radius:8px;display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue';color:#fff;font-size:1.1rem;flex-shrink:0;">F1</div>
      <div>
        <div style="font-family:'Barlow Condensed';font-weight:800;color:#111;font-size:.9rem;letter-spacing:.05em;text-transform:uppercase;">Admin Panel</div>
        <div style="font-family:'Barlow';font-size:.72rem;color:#9ca3af;">Formula 1 · 2026</div>
      </div>
    </div>
  </div>

  <nav style="padding:16px 12px;flex:1;display:flex;flex-direction:column;gap:2px;">
    <div style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;padding:8px 8px 4px;">Principal</div>
    <a href="{{ route('admin.dashboard') }}" class="adm-link {{ request()->routeIs('admin.dashboard') ? 'adm-active' : '' }}">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
      Dashboard
    </a>

    <div style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;padding:12px 8px 4px;">Contenido</div>
    <a href="{{ route('admin.circuitos') }}" class="adm-link {{ request()->routeIs('admin.circuitos*') ? 'adm-active' : '' }}">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="8"/></svg>
      Circuitos
    </a>
    <a href="{{ route('admin.rumores') }}" class="adm-link {{ request()->routeIs('admin.rumores*') ? 'adm-active' : '' }}">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      Rumores
    </a>
    <a href="{{ route('admin.noticias') }}" class="adm-link {{ request()->routeIs('admin.noticias*') ? 'adm-active' : '' }}">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      Noticias
    </a>

    <div style="font-family:'Barlow Condensed';font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#9ca3af;padding:12px 8px 4px;">Sistema</div>
    <a href="{{ route('admin.usuarios') }}" class="adm-link {{ request()->routeIs('admin.usuarios*') ? 'adm-active' : '' }}">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Usuarios
    </a>
    <a href="{{ route('admin.log') }}" class="adm-link {{ request()->routeIs('admin.log') ? 'adm-active' : '' }}">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      Log actividad
    </a>
  </nav>

  <div style="padding:16px 12px;border-top:1px solid #f3f4f6;">
    <div style="display:flex;align-items:center;gap:10px;padding:8px;border-radius:8px;background:#f9fafb;margin-bottom:8px;">
      <div style="width:32px;height:32px;border-radius:50%;background:#E8002D;display:flex;align-items:center;justify-content:center;font-family:'Barlow Condensed';font-weight:700;color:#fff;font-size:.85rem;flex-shrink:0;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
      <div style="min-width:0;">
        <div style="font-family:'Barlow Condensed';font-weight:700;color:#111;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->name }}</div>
        <div style="font-family:'Barlow';font-size:.68rem;color:#9ca3af;">Administrador</div>
      </div>
    </div>
    <a href="{{ url('/') }}" style="display:flex;align-items:center;gap:8px;padding:8px;border-radius:6px;font-family:'Barlow Condensed';font-weight:600;font-size:.75rem;letter-spacing:.08em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#f3f4f6';this.style.color='#111'" onmouseout="this.style.background='transparent';this.style.color='#6b7280'">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      Ver web
    </a>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:2px;">
      @csrf
      <button type="submit" style="display:flex;align-items:center;gap:8px;width:100%;padding:8px;border-radius:6px;font-family:'Barlow Condensed';font-weight:600;font-size:.75rem;letter-spacing:.08em;text-transform:uppercase;color:#E8002D;background:none;border:none;cursor:pointer;transition:background .2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Cerrar sesión
      </button>
    </form>
  </div>
</aside>

<style>
  .adm-link{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;font-family:'Barlow Condensed',sans-serif;font-weight:600;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:#6b7280;text-decoration:none;transition:all .2s;}
  .adm-link:hover{background:#f9fafb;color:#111;}
  .adm-active{background:#fff1f2;color:#E8002D !important;border-left:3px solid #E8002D;padding-left:7px;}
</style>
