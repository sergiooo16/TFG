<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Recuperar Contraseña – F1 2026</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            'f1r':     '#E8002D',
            'f1dark':  '#080809',
            'f1card':  '#0E0E12',
            'f1border':'#1A1A22',
          },
        }
      }
    }
  </script>
  <style>
    :root { --red:#E8002D; --dark:#080809; --card:#0E0E12; --border:#1A1A22; }
    *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
    body { background:var(--dark); font-family:'Barlow',sans-serif; color:#ddd; min-height:100vh; display:flex; flex-direction:column; }
    ::-webkit-scrollbar { width:5px; }
    ::-webkit-scrollbar-track { background:var(--dark); }
    ::-webkit-scrollbar-thumb { background:var(--red); border-radius:3px; }
    .bg-grid { position:fixed; inset:0; z-index:0; background-image: repeating-linear-gradient(0deg,rgba(255,255,255,.025) 0,rgba(255,255,255,.025) 1px,transparent 1px,transparent 44px), repeating-linear-gradient(90deg,rgba(255,255,255,.025) 0,rgba(255,255,255,.025) 1px,transparent 1px,transparent 44px); }
    .top-bar { height:3px; background:linear-gradient(90deg,transparent,var(--red),transparent); }
    .login-card { background:var(--card); border:1px solid var(--border); border-radius:18px; box-shadow:0 24px 64px rgba(0,0,0,.7); }
    .f1-input { width:100%; background:#0a0a10; border:1px solid var(--border); color:#ddd; border-radius:8px; padding:12px 16px; font-family:'Barlow',sans-serif; font-size:.95rem; outline:none; transition:border-color .25s, box-shadow .25s; }
    .f1-input:focus { border-color:rgba(232,0,45,.6); box-shadow:0 0 0 3px rgba(232,0,45,.08); }
    .f1-input::placeholder { color:#333; }
    .f1-input.is-invalid { border-color:#e55; }
    .btn-f1 { width:100%; background:var(--red); color:#fff; font-family:'Bebas Neue',sans-serif; letter-spacing:.1em; font-size:1.1rem; padding:14px; border-radius:8px; border:none; cursor:pointer; transition:background .2s, transform .15s, box-shadow .25s; }
    .btn-f1:hover { background:#c70027; transform:translateY(-2px); box-shadow:0 8px 22px rgba(232,0,45,.4); }
    .f1-label { font-family:'Barlow Condensed',sans-serif; font-weight:600; font-size:.75rem; letter-spacing:.15em; text-transform:uppercase; color:#666; margin-bottom:6px; display:block; }
    .f1-error { font-family:'Barlow',sans-serif; font-size:.8rem; color:#e55; margin-top:5px; }
    .speed-line { position:fixed; height:1px; background:linear-gradient(90deg,transparent,rgba(232,0,45,.3),transparent); pointer-events:none; animation:sl linear infinite; }
    @keyframes sl { from{transform:translateX(-100%);opacity:0} 15%{opacity:1} 85%{opacity:1} to{transform:translateX(200%);opacity:0} }
  </style>
</head>
<body class="font-barlow">

  <div class="top-bar"></div>
  <div class="bg-grid"></div>

  <div class="speed-line" style="top:25%;width:55%;animation-duration:3.8s;animation-delay:0s;"></div>
  <div class="speed-line" style="top:60%;width:70%;animation-duration:4.5s;animation-delay:1.2s;"></div>
  <div class="speed-line" style="top:80%;width:40%;animation-duration:3.2s;animation-delay:2.1s;"></div>

  <nav class="relative z-10 px-6 md:px-12 py-4 flex items-center justify-between border-b border-f1border" style="background:rgba(8,8,9,.8);backdrop-filter:blur(20px);">
    <a href="{{ url('/') }}" class="flex items-center gap-3">
      <div class="w-9 h-9 bg-f1r flex items-center justify-center rounded font-bebas text-white text-xl tracking-wider leading-none">F1</div>
      <span class="font-bc font-700 tracking-[.2em] text-white text-sm uppercase hidden sm:block">World <span class="text-f1r">Championship</span></span>
    </a>
    <a href="{{ route('login') }}" class="font-bc font-700 tracking-[.1em] text-xs text-gray-400 hover:text-white border border-gray-700 hover:border-gray-400 px-4 py-2 rounded-lg transition-all uppercase">
      Login
    </a>
  </nav>

  <div class="relative z-10 flex-1 flex items-center justify-center px-4 py-16">
    <div class="w-full max-w-md">

      <div class="text-center mb-8">
        <div class="inline-flex items-center gap-2 mb-4">
          <div class="h-px w-8 bg-f1r"></div>
          <span class="font-bc font-700 tracking-[.2em] text-f1r text-xs uppercase">Recuperar</span>
          <div class="h-px w-8 bg-f1r"></div>
        </div>
        <h1 class="font-bebas text-5xl text-white tracking-wide">Recuperar Contraseña</h1>
        <p class="font-barlow text-gray-500 text-sm mt-2">Te enviaremos un enlace para restablecer tu contraseña</p>
      </div>

      <div class="login-card p-8">

        @if (session('status'))
          <div class="mb-6 px-4 py-3 rounded-lg font-bc text-sm tracking-[.05em]" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;">
            ✓ {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="mb-7">
            <label for="email" class="f1-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
              placeholder="tu@email.com"
              class="f1-input {{ $errors->has('email') ? 'is-invalid' : '' }}">
            @error('email')
              <p class="f1-error">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" class="btn-f1">
            Enviar Enlace de Recuperación →
          </button>

        </form>

        <div class="flex items-center gap-4 my-6">
          <div class="flex-1 h-px bg-f1border"></div>
          <span class="font-bc text-xs text-gray-700 tracking-[.1em] uppercase">o</span>
          <div class="flex-1 h-px bg-f1border"></div>
        </div>

        <div class="text-center">
          <span class="font-barlow text-gray-600 text-sm">¿Recuerdas tu contraseña?</span>
          <a href="{{ route('login') }}" class="font-bc font-700 text-f1r hover:text-red-400 text-sm tracking-[.06em] ml-2 transition-colors uppercase">
            Inicia sesión
          </a>
        </div>

      </div>

      <div class="text-center mt-6">
        <a href="{{ url('/') }}" class="font-bc text-xs text-gray-600 hover:text-gray-400 tracking-[.12em] uppercase transition-colors">
          ← Volver al inicio
        </a>
      </div>

    </div>
  </div>

</body>
</html>
