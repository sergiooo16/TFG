<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>F1 2026 – Formula 1 World Championship</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Barlow+Condensed:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            bebas:  ['Bebas Neue', 'sans-serif'],
            barlow: ['Barlow', 'sans-serif'],
            bc:     ['Barlow Condensed', 'sans-serif'],
          },
          colors: {
            'f1r': '#E8002D',
            'f1g': '#FFD700',
            'f1dark': '#080809',
            'f1card': '#0E0E12',
            'f1border': '#1A1A22',
          },
        }
      }
    }
  </script>
  <link rel="stylesheet" href="{{ asset('css/f1.css') }}">
  <style>
    /* ── PILOTOS COLAPSABLE MÓVIL ── */
    #driversCollapse { display:none; }
    /* Desktop: siempre visible */
    @media (min-width:768px) {
      #driversGrid { max-height:none !important; overflow:visible !important; }
    }
    @media (max-width:767px) {
      #driversCollapse { display:flex; justify-content:center; margin-top:1rem; }
      #driversGrid.collapsed { max-height:400px; overflow:hidden; transition:max-height .4s ease; }
      #driversGrid.expanded  { max-height:9999px; transition:max-height .6s ease; }
    }

    /* ── CIRCUITOS CARRUSEL MÓVIL ── */
    @media (max-width:767px) {
      #circuitsGrid {
        display:flex !important;
        flex-wrap:nowrap !important;
        overflow-x:auto !important;
        gap:14px !important;
        padding-bottom:12px;
        scroll-snap-type:x mandatory;
        -webkit-overflow-scrolling:touch;
      }
      #circuitsGrid::-webkit-scrollbar { display:none; }
      #circuitsGrid > * {
        flex:0 0 78vw;
        scroll-snap-align:start;
      }
    }

    /* ── HERO MÓVIL: imagen en vez de vídeo ── */
    @media (max-width:767px) {
      #hero-video { display:none; }
      #hero-mobile-bg { display:block !important; }
    }
  </style>
</head>
<body class="font-barlow">

<!-- ══════════════ NAVBAR ══════════════ -->
<nav id="navbar" class="fixed top-0 inset-x-0 z-50 px-6 md:px-12 py-4 flex items-center justify-between" style="background:transparent">
  <a href="#" class="flex items-center gap-3">
    <div class="w-9 h-9 bg-f1r flex items-center justify-center rounded font-bebas text-white text-xl tracking-wider leading-none">F1</div>
    <span class="font-bc font-700 tracking-[.2em] text-white text-sm uppercase hidden sm:block">World <span class="text-f1r">Championship</span></span>
  </a>
  <div class="hidden md:flex items-center gap-8">
    <a href="#drivers"   class="nav-link font-bc font-600 tracking-[.15em] text-sm text-gray-400 hover:text-white transition-colors uppercase">Pilotos</a>
    <a href="#standings" class="nav-link font-bc font-600 tracking-[.15em] text-sm text-gray-400 hover:text-white transition-colors uppercase">Clasificación</a>
    <a href="#circuits"  class="nav-link font-bc font-600 tracking-[.15em] text-sm text-gray-400 hover:text-white transition-colors uppercase">Circuitos</a>
    <a href="#news"      class="nav-link font-bc font-600 tracking-[.15em] text-sm text-gray-400 hover:text-white transition-colors uppercase">Noticias</a>
  </div>
  <div class="flex items-center gap-3">
    @auth
        @if(Auth::user()->is_admin)
            <a href="{{ url('/admin') }}" class="hidden sm:inline-block font-bc font-700 tracking-[.1em] text-xs text-f1r border border-f1r/40 hover:bg-f1r hover:text-white px-4 py-2 rounded-lg transition-all uppercase">Panel Admin</a>
        @endif
    @endauth
    <a href="#circuits" class="btn-buy text-sm py-2.5 px-5 hidden sm:inline-block">Entradas</a>
    @guest
      <a href="{{ route('login') }}" class="hidden sm:inline-block font-bc font-700 tracking-[.1em] text-xs text-gray-300 hover:text-white border border-gray-700 px-4 py-2 rounded-lg uppercase">Login</a>
      <a href="{{ route('register') }}" class="hidden sm:inline-block font-bc font-700 tracking-[.1em] text-xs text-white bg-gray-800 border border-gray-600 px-4 py-2 rounded-lg uppercase">Register</a>
    @else
      <form method="POST" action="{{ route('logout') }}" class="hidden sm:inline-block">
        @csrf
        <button type="submit" class="font-bc font-700 text-xs text-gray-300 hover:text-white border border-gray-700 px-4 py-2 rounded-lg uppercase">{{ Auth::user()->name }} · Logout</button>
      </form>
    @endguest
  </div>
  <button class="md:hidden p-2 flex flex-col gap-1.5" onclick="toggleMenu()">
    <span class="w-6 h-px bg-white block"></span>
    <span class="w-6 h-px bg-white block"></span>
    <span class="w-4 h-px bg-white block"></span>
  </button>
</nav>
<div id="mobileMenu" class="fixed top-16 inset-x-0 z-40 hidden flex-col gap-4 px-6 py-5 bg-f1card border-b border-f1border">
  <a href="#drivers"   onclick="closeMenu()" class="font-bc font-600 tracking-[.15em] text-sm text-gray-300 uppercase">Pilotos</a>
  <a href="#standings" onclick="closeMenu()" class="font-bc font-600 tracking-[.15em] text-sm text-gray-300 uppercase">Clasificación</a>
  <a href="#circuits"  onclick="closeMenu()" class="font-bc font-600 tracking-[.15em] text-sm text-gray-300 uppercase">Circuitos</a>
  <a href="#news"      onclick="closeMenu()" class="font-bc font-600 tracking-[.15em] text-sm text-gray-300 uppercase">Noticias</a>
  <a href="#circuits"  onclick="closeMenu()" class="btn-buy text-sm py-2.5 px-5 w-max">Entradas</a>
  <div class="border-t border-f1border pt-4 flex flex-col gap-3">
    @auth
      @if(Auth::user()->is_admin)
        <a href="{{ url('/admin') }}" class="font-bc font-700 tracking-[.1em] text-xs text-f1r border border-f1r/40 px-4 py-2 rounded-lg uppercase w-max">Panel Admin</a>
      @endif
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="font-bc font-700 text-xs text-gray-300 border border-gray-700 px-4 py-2 rounded-lg uppercase">{{ Auth::user()->name }} · Logout</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="font-bc font-700 tracking-[.1em] text-xs text-gray-300 border border-gray-700 px-4 py-2 rounded-lg uppercase w-max">Login</a>
      <a href="{{ route('register') }}" class="font-bc font-700 tracking-[.1em] text-xs text-white bg-gray-800 border border-gray-600 px-4 py-2 rounded-lg uppercase w-max">Register</a>
    @endauth
  </div>
</div>

<!-- ══════════════ HERO ══════════════ -->
<section id="hero">
  <video id="hero-video" autoplay muted loop playsinline preload="auto">
    <source src="https://res.cloudinary.com/dkx2maawi/video/upload/v1779367169/videoplayback_tplcbi.mp4" type="video/mp4">
  </video>
  {{-- Imagen de fondo para móvil --}}
  <div id="hero-mobile-bg" style="display:none;position:absolute;inset:0;background:url('{{ asset('asstes/fondoMovill.jpg') }}') center center/cover no-repeat;"></div>
  <div id="hero-overlay"></div>
  <div class="speed-line" style="top:30%;width:50%;animation-duration:3.5s;animation-delay:0s;"></div>
  <div class="speed-line" style="top:47%;width:72%;animation-duration:4.2s;animation-delay:.9s;"></div>
  <div class="speed-line" style="top:63%;width:44%;animation-duration:2.9s;animation-delay:1.8s;"></div>
  <div class="hero-content text-center px-6 max-w-2xl mx-auto" style="position:absolute; bottom:10%; left:50%; transform:translateX(-50%); width:100%;">
    <div class="fade-up flex flex-wrap gap-3 justify-center mb-10 bg-black/20 backdrop-blur-sm rounded-2xl px-6 py-4" id="countdown-wrap" style="animation-delay:.5s">
      <div class="cd-box px-5 py-3 text-center">
        <div class="font-bc font-700 tracking-[.18em] text-f1r text-xs uppercase mb-1">Próxima carrera · 🇨🇦 Canadá</div>
        <div class="font-bc font-700 text-white text-sm tracking-wide">22–24 Mayo 2026</div>
      </div>
      <div class="cd-box px-4 py-3 text-center min-w-[66px]">
        <div id="cd-days"  class="font-bebas text-white text-3xl leading-none">--</div>
        <div class="font-bc text-f1r text-xs tracking-[.15em] uppercase mt-1">días</div>
      </div>
      <div class="cd-box px-4 py-3 text-center min-w-[66px]">
        <div id="cd-hours" class="font-bebas text-white text-3xl leading-none">--</div>
        <div class="font-bc text-f1r text-xs tracking-[.15em] uppercase mt-1">horas</div>
      </div>
      <div class="cd-box px-4 py-3 text-center min-w-[66px]">
        <div id="cd-mins"  class="font-bebas text-white text-3xl leading-none">--</div>
        <div class="font-bc text-f1r text-xs tracking-[.15em] uppercase mt-1">min</div>
      </div>
      <div class="cd-box px-4 py-3 text-center min-w-[66px]">
        <div id="cd-secs"  class="font-bebas text-white text-3xl leading-none">--</div>
        <div class="font-bc text-f1r text-xs tracking-[.15em] uppercase mt-1">seg</div>
      </div>
    </div>
    <div class="fade-up flex gap-4 flex-wrap justify-center" style="animation-delay:.65s">
      <a href="#drivers" class="btn-buy" style="font-size:1.4rem; padding: 18px 50px;">Ver Pilotos</a>
    </div>
  </div>
</section>

<!-- ══════════════ STATS ══════════════ -->
<div class="border-y border-f1border bg-f1card relative z-10">
  <div class="max-w-7xl mx-auto px-6 py-5 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
    <div class="reveal"><div class="font-bebas text-f1r text-4xl">22</div><div class="font-bc text-xs text-gray-600 tracking-[.15em] uppercase mt-0.5">Pilotos</div></div>
    <div class="reveal" style="transition-delay:.08s"><div class="font-bebas text-f1r text-4xl">11</div><div class="font-bc text-xs text-gray-600 tracking-[.15em] uppercase mt-0.5">Equipos</div></div>
    <div class="reveal" style="transition-delay:.16s"><div class="font-bebas text-f1r text-4xl">22</div><div class="font-bc text-xs text-gray-600 tracking-[.15em] uppercase mt-0.5">Grandes Premios</div></div>
    <div class="reveal" style="transition-delay:.24s"><div class="font-bebas text-f1g text-4xl">2026</div><div class="font-bc text-xs text-gray-600 tracking-[.15em] uppercase mt-0.5">Nueva Reglamentación</div></div>
  </div>
</div>

<!-- ══════════════ PILOTOS ══════════════ -->
<section id="drivers" class="max-w-7xl mx-auto px-6 py-24">
  <div class="mb-12 reveal">
    <div class="divider"></div>
    <div class="sec-sub">Temporada 2026</div>
    <h2 class="sec-title text-5xl md:text-6xl text-white">Los 22 Pilotos</h2>
    <p class="font-barlow text-gray-500 mt-3 max-w-xl">La parrilla más completa de la historia. 11 equipos incluyendo Cadillac y la era Audi.</p>
  </div>
  <div class="flex flex-wrap gap-3 mb-10 reveal" style="transition-delay:.08s">
    <input type="text" id="driverSearch" class="s-inp" placeholder="Buscar piloto o equipo..." oninput="filterDrivers()">
    <div class="flex gap-2 flex-wrap" id="teamFilterBtns">
      <button class="tab-btn active" onclick="setTeamFilter(this,'all')">Todos</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'mclaren')">McLaren</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'mercedes')">Mercedes</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'redbull')">Red Bull</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'ferrari')">Ferrari</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'williams')">Williams</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'astonmartin')">Aston Martin</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'haas')">Haas</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'audi')">Audi</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'alpine')">Alpine</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'racingbulls')">Racing Bulls</button>
      <button class="tab-btn" onclick="setTeamFilter(this,'cadillac')">Cadillac</button>
    </div>
  </div>

  {{-- Grid colapsable en móvil --}}
  <div id="driversGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 collapsed"></div>

  {{-- Botón expandir/colapsar solo en móvil --}}
  <div id="driversCollapse" class="mt-6">
    <button onclick="toggleDrivers(this)"
      class="font-bc font-700 tracking-[.1em] text-sm px-8 py-3 rounded-lg border border-f1r text-f1r uppercase transition-all hover:bg-f1r hover:text-white">
      Ver todos los pilotos ↓
    </button>
  </div>
</section>

<!-- ══════════════ CLASIFICACIÓN ══════════════ -->
<section id="standings" class="py-24 relative" style="background:linear-gradient(180deg,#080809 0%,#09090e 50%,#080809 100%)">
  <div class="absolute inset-0 opacity-[.025]" style="background-image:repeating-linear-gradient(0deg,#fff 0,#fff 1px,transparent 1px,transparent 44px),repeating-linear-gradient(90deg,#fff 0,#fff 1px,transparent 1px,transparent 44px)"></div>
  <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="mb-12 reveal">
      <div class="divider"></div>
      <div class="sec-sub">Actualización automática cada 3 días</div>
      <div class="flex flex-wrap items-end gap-4">
        <h2 class="sec-title text-5xl md:text-6xl text-white">Clasificación Mundial</h2>
        <span class="blink inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-500/10 border border-green-500/30 text-green-400 text-xs font-bc tracking-[.1em] uppercase mb-1">
          <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>Live API
        </span>
      </div>
    </div>
    <div class="flex gap-3 mb-8 reveal" style="transition-delay:.08s">
      <button class="tab-btn active" onclick="switchTab('drivers',this)">Pilotos</button>
      <button class="tab-btn"        onclick="switchTab('constructors',this)">Constructores</button>
    </div>
    <div class="reveal" style="transition-delay:.16s">
      <div id="s-driver">
        <div id="s-loading" class="py-16 text-center text-gray-600 font-bc tracking-[.15em] text-sm">
          <div class="w-8 h-8 border-2 border-f1r border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
          CARGANDO DATOS...
        </div>
        <table class="s-table hidden" id="driversTable">
          <thead><tr class="font-bc text-xs tracking-[.12em] text-gray-600 uppercase">
            <th class="text-left pl-4 pb-3 w-10">Pos</th>
            <th class="text-left pb-3">Piloto</th>
            <th class="text-left pb-3 hidden md:table-cell">Equipo</th>
            <th class="text-right pr-4 pb-3">Pts</th>
          </tr></thead>
          <tbody id="driversTbody"></tbody>
        </table>
      </div>
      <div id="s-constructor" class="hidden">
        <table class="s-table">
          <thead><tr class="font-bc text-xs tracking-[.12em] text-gray-600 uppercase">
            <th class="text-left pl-4 pb-3 w-10">Pos</th>
            <th class="text-left pb-3">Equipo</th>
            <th class="text-right pr-4 pb-3">Pts</th>
          </tr></thead>
          <tbody id="constructorsTbody"></tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════ CIRCUITOS ══════════════ -->
<section id="circuits" class="max-w-7xl mx-auto px-6 py-24">
  <div class="mb-12 reveal">
    <div class="divider"></div>
    <div class="sec-sub">22 Grandes Premios · 5 Continentes</div>
    <h2 class="sec-title text-5xl md:text-6xl text-white">Circuitos & Entradas</h2>
    <p class="font-barlow text-gray-500 mt-3 max-w-xl">Escoge tu Gran Premio, elige la entrada y vive la Fórmula 1 desde dentro.</p>
  </div>
  {{-- Carrusel en móvil, grid en desktop --}}
  <div id="circuitsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5"></div>
  {{-- Indicador de scroll solo en móvil --}}
  <p class="md:hidden text-center text-gray-600 font-bc text-xs tracking-[.12em] uppercase mt-4">← Desliza para ver más →</p>
</section>

<!-- ══════════════ NOTICIAS ══════════════ -->
<section id="news" class="max-w-7xl mx-auto px-6 py-24">
  <div class="mb-12 reveal">
    <div class="divider"></div>
    <div class="sec-sub">Fuentes oficiales · Actualización automática</div>
    <div class="flex flex-wrap items-end gap-4">
      <h2 class="sec-title text-5xl md:text-6xl text-white">Últimas <span style="color:var(--red)">Noticias</span></h2>
      <span class="blink inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-bc tracking-[.1em] uppercase mb-1">
        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Live Feed
      </span>
    </div>
    <p class="font-barlow text-gray-500 mt-3 max-w-xl">Las últimas noticias del mundo de la Fórmula 1, directo desde Motorsport.com y Autosport.</p>
  </div>
  <div id="newsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    <div class="col-span-full py-12 text-center text-gray-600 font-bc tracking-[.15em] text-sm">
      <div class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
      CARGANDO NOTICIAS...
    </div>
  </div>
  <div class="text-center mt-10 reveal">
    <a href="https://www.motorsport.com/f1/news/" target="_blank" class="font-bc font-700 tracking-[.1em] text-sm px-8 py-3 rounded-lg border border-f1border text-gray-400 hover:border-f1r/50 hover:text-white transition-all uppercase">Ver todas las noticias →</a>
  </div>
</section>

<!-- ══════════════ RUMORES ══════════════ -->
<section id="rumors" class="py-24 relative" style="background:linear-gradient(180deg,#080809 0%,#09090e 50%,#080809 100%)">
  <div class="absolute inset-0 opacity-[.025]" style="background-image:repeating-linear-gradient(0deg,#fff 0,#fff 1px,transparent 1px,transparent 44px),repeating-linear-gradient(90deg,#fff 0,#fff 1px,transparent 1px,transparent 44px)"></div>
  <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="mb-12 reveal">
      <div class="divider" style="background:var(--gold)"></div>
      <div class="sec-sub" style="color:var(--gold)">Mercado de Pilotos 2026–2027</div>
      <h2 class="sec-title text-5xl md:text-6xl text-white">Rumores de <span style="color:var(--gold)">Fichajes</span></h2>
      <p class="font-barlow text-gray-500 mt-3 max-w-xl">Los últimos movimientos del mercado. Credibilidad basada en fuentes contrastadas.</p>
    </div>
    <div id="rumorsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5"></div>
  </div>
</section>

<!-- ══════════════ FOOTER ══════════════ -->
<footer class="border-t border-f1border py-10 px-6">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-5">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 bg-f1r flex items-center justify-center rounded font-bebas text-white text-lg leading-none">F1</div>
      <span class="font-bc text-gray-600 text-xs tracking-[.2em] uppercase">Formula 1 · Temporada 2026</span>
    </div>
    <p class="font-barlow text-gray-700 text-xs">© 2026 Formula One World Championship Ltd. · Datos via <a href="https://api.jolpi.ca" class="text-gray-500 hover:text-f1r transition-colors">Jolpica F1 API</a></p>
    <div class="flex gap-6">
      <a href="#drivers"   class="font-bc text-gray-600 text-xs hover:text-f1r tracking-[.12em] uppercase transition-colors">Pilotos</a>
      <a href="#standings" class="font-bc text-gray-600 text-xs hover:text-f1r tracking-[.12em] uppercase transition-colors">Clasificación</a>
      <a href="#circuits"  class="font-bc text-gray-600 text-xs hover:text-f1r tracking-[.12em] uppercase transition-colors">Circuitos</a>
      <a href="#news"      class="font-bc text-gray-600 text-xs hover:text-f1r tracking-[.12em] uppercase transition-colors">Noticias</a>
    </div>
  </div>
</footer>

<!-- ══════════════ MODAL ══════════════ -->
<div id="modal-overlay" onclick="overlayClose(event)">
  <div id="modal-box" class="p-6 md:p-8"></div>
</div>

<script>
  const CIRCUITS = @json($circuitosData);
  const API_NEWS_URL   = '{{ url("/api/f1-news") }}';
  const API_RUMORS_URL = '{{ url("/api/f1-rumors") }}';

  function toggleDrivers(btn) {
    if (window.innerWidth >= 768) return;
    const grid = document.getElementById('driversGrid');
    const expanded = grid.classList.contains('expanded');
    if (expanded) {
      grid.classList.remove('expanded');
      grid.classList.add('collapsed');
      btn.textContent = 'Ver todos los pilotos ↓';
    } else {
      grid.classList.remove('collapsed');
      grid.classList.add('expanded');
      btn.textContent = 'Ocultar pilotos ↑';
    }
  }
</script>
<script src="{{ asset('js/f1.js') }}"></script>
</body>
</html>
