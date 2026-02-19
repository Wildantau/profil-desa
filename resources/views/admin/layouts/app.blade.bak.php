{{-- resources/views/admin/layouts/app.blade.php --}}
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Admin • Portal Desa')</title>

  {{-- Aman: jika pakai Vite --}}
  @if (function_exists('vite'))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @stack('styles')

  <style>
    :root{
      --ink:#0f172a;
      --muted:#64748b;
      --line:rgba(15,23,42,.10);
      --card:rgba(255,255,255,.92);
      --shadow: 0 18px 45px rgba(2,6,23,.08);
      --shadow2: 0 10px 28px rgba(2,6,23,.06);
      --r14:14px; --r18:18px; --r22:22px; --r24:24px;
      --g1: rgba(96,165,250,.18);
      --g2: rgba(34,197,94,.16);
      --g3: rgba(168,85,247,.14);
    }

    *{ box-sizing:border-box; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Liberation Sans", sans-serif;
      color:var(--ink);
      background:
        radial-gradient(900px 520px at 12% 0%, var(--g1), transparent 60%),
        radial-gradient(900px 520px at 88% 10%, var(--g2), transparent 55%),
        radial-gradient(900px 520px at 50% 100%, var(--g3), transparent 55%),
        linear-gradient(180deg, #f6f9ff, #f7fff8);
      min-height:100vh;
    }

    a{ color:inherit; }
    .adm-shell{ display:flex; min-height:100vh; }

    /* SIDEBAR */
    .side{
      width:280px;
      padding:18px 16px;
      border-right:1px solid rgba(15,23,42,.08);
      background: rgba(255,255,255,.55);
      backdrop-filter: blur(10px);
      position:sticky; top:0;
      height:100vh;
      overflow:auto;
    }
    .brand{
      display:flex; align-items:center; gap:12px;
      padding:12px 12px;
      border-radius: var(--r18);
      background: rgba(255,255,255,.72);
      border:1px solid rgba(15,23,42,.10);
      box-shadow: var(--shadow2);
    }
    .logo{
      width:42px; height:42px;
      border-radius:14px;
      border:1px solid rgba(15,23,42,.12);
      background: linear-gradient(135deg, rgba(34,197,94,.22), rgba(96,165,250,.20), rgba(168,85,247,.16));
      display:flex; align-items:center; justify-content:center;
      box-shadow: 0 12px 26px rgba(2,6,23,.10);
      flex:0 0 auto;
    }
    .logo svg{ width:20px; height:20px; color:var(--ink); }
    .brand h1{
      margin:0;
      font-size:14px;
      font-weight:950;
      letter-spacing:-.02em;
      line-height:1.15;
    }
    .brand p{
      margin:2px 0 0;
      font-size:12px;
      color:var(--muted);
      font-weight:800;
    }

    .nav{
      margin-top:14px;
      display:flex;
      flex-direction:column;
      gap:8px;
    }
    .nav-title{
      margin:10px 8px 6px;
      font-size:11px;
      letter-spacing:.14em;
      text-transform:uppercase;
      color:var(--muted);
      font-weight:950;
    }
    .nav a{
      display:flex; align-items:center; gap:10px;
      padding:10px 12px;
      border-radius: var(--r18);
      text-decoration:none;
      border:1px solid rgba(15,23,42,.10);
      background: rgba(255,255,255,.72);
      box-shadow: var(--shadow2);
      font-weight:900;
      font-size:13px;
      transition: transform .15s ease, border-color .15s ease, box-shadow .15s ease, opacity .15s ease;
    }
    .nav a:hover{
      transform: translateY(-1px);
      border-color: rgba(16,185,129,.22);
      box-shadow: 0 16px 34px rgba(2,6,23,.10);
    }
    .nav a.is-active{
      border-color: rgba(16,185,129,.28);
      background: linear-gradient(135deg, rgba(16,185,129,.14), rgba(56,189,248,.10));
    }
    .nav a.is-disabled{
      opacity:.55;
      cursor:not-allowed;
      pointer-events:none;
    }
    .ic{
      width:18px; height:18px; display:inline-flex; align-items:center; justify-content:center;
      opacity:.95;
    }
    .tag-soon{
      margin-left:auto;
      font-size:10px;
      letter-spacing:.12em;
      text-transform:uppercase;
      color:var(--muted);
      font-weight:950;
      border:1px solid rgba(15,23,42,.10);
      background: rgba(248,250,252,.9);
      padding:4px 8px;
      border-radius:999px;
      white-space:nowrap;
    }

    .side-footer{
      margin-top:14px;
      padding:12px 12px;
      border-radius: var(--r18);
      border:1px solid rgba(15,23,42,.10);
      background: rgba(255,255,255,.60);
      color:var(--muted);
      font-size:12px;
      line-height:1.6;
      font-weight:800;
    }
    .side-footer a{ text-decoration:none; font-weight:950; color:var(--ink); }
    .side-footer a:hover{ text-decoration:underline; }

    /* CONTENT */
    .main{
      flex:1;
      padding:18px 18px 40px;
      min-width:0;
    }
    .topbar{
      display:flex; align-items:center; justify-content:space-between; gap:12px;
      padding:14px 16px;
      border-radius: var(--r24);
      background: var(--card);
      border:1px solid rgba(15,23,42,.10);
      box-shadow: var(--shadow);
      backdrop-filter: blur(10px);
    }
    .topbar .ttl{
      margin:0;
      font-size:16px;
      font-weight:950;
      letter-spacing:-.02em;
    }
    .topbar .sub{
      margin:2px 0 0;
      font-size:12px;
      color:var(--muted);
      font-weight:800;
    }
    .top-actions{ display:flex; gap:10px; flex-wrap:wrap; }
    .btn{
      appearance:none; border:none; cursor:pointer;
      padding:10px 12px;
      border-radius: 16px;
      font-weight:950;
      font-size:13px;
      color:var(--ink);
      background: rgba(255,255,255,.92);
      border:1px solid rgba(15,23,42,.12);
      box-shadow: var(--shadow2);
      text-decoration:none;
      display:inline-flex; gap:10px; align-items:center;
      transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
    }
    .btn:hover{ transform: translateY(-1px); box-shadow: 0 16px 34px rgba(2,6,23,.10); border-color: rgba(16,185,129,.20); }

    /* FLASH */
    .flash-wrap{ margin-top:12px; display:grid; gap:10px; }
    .flash{
      border-radius:18px;
      padding:12px 14px;
      font-weight:900;
      box-shadow: var(--shadow2);
      border:1px solid rgba(15,23,42,.10);
      background: rgba(255,255,255,.92);
    }
    .flash.ok{
      border-color: rgba(34,197,94,.25);
      background: rgba(34,197,94,.10);
      color:#065f46;
    }
    .flash.err{
      border-color: rgba(239,68,68,.25);
      background: rgba(239,68,68,.10);
      color:#7f1d1d;
    }
    .flash ul{ margin:8px 0 0; padding-left:18px; }
    .flash li{ margin:2px 0; font-weight:800; }

    /* RESPONSIVE */
    .m-toggle{ display:none; }
    @media(max-width: 980px){
      .side{
        position:fixed;
        left:0; top:0;
        transform: translateX(-110%);
        transition: transform .18s ease;
        z-index:50;
        height:100vh;
      }
      .side.is-open{ transform: translateX(0); }
      .main{ padding:14px 14px 40px; }
      .m-toggle{ display:inline-flex; }
      .overlay{
        position:fixed; inset:0;
        background: rgba(2,6,23,.35);
        backdrop-filter: blur(2px);
        z-index:40;
        display:none;
      }
      .overlay.is-show{ display:block; }
    }
  </style>
</head>

<body>
@php
  // Active helper (lebih aman dan akurat)
  $is = fn($p) => request()->is($p);

  // Dashboard aktif untuk /admin dan semua subpath admin kecuali perangkat-desa
  $dashActive = $is('admin') && !$is('admin/perangkat-desa*');

  // Link menu "soon" (belum dibuat routenya)
  $soonItems = [
    ['path' => 'admin/profil-desa*',   'label' => 'Profil Desa (PRODESKEL)', 'icon' => '📄'],
    ['path' => 'admin/data-penduduk*', 'label' => 'Data Penduduk',          'icon' => '👥'],
    ['path' => 'admin/umkm*',          'label' => 'UMKM',                   'icon' => '🧺'],
    ['path' => 'admin/wisata*',        'label' => 'Wisata',                 'icon' => '🗺️'],
  ];
@endphp

<div class="adm-shell">

  {{-- MOBILE OVERLAY --}}
  <div class="overlay" id="admOverlay" aria-hidden="true"></div>

  {{-- SIDEBAR --}}
  <aside class="side" id="admSide">
    <div class="brand">
      <div class="logo" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M12 3l8 4v6c0 5-3.5 8-8 8s-8-3-8-8V7l8-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
          <path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div>
        <h1>Admin Portal Desa</h1>
        <p>Siap demo KKN (SQLite)</p>
      </div>
    </div>

    <nav class="nav">
      <div class="nav-title">Utama</div>

      <a href="{{ route('admin.dashboard') }}"
         class="{{ $dashActive ? 'is-active' : '' }}">
        <span class="ic">🏠</span> Dashboard
      </a>

      <div class="nav-title">Data Desa</div>

      {{-- Menu yang belum ada: tampil (soon), tidak error, dan tidak bisa diklik --}}
      @foreach($soonItems as $it)
        <a href="javascript:void(0)"
           class="is-disabled {{ $is($it['path']) ? 'is-active' : '' }}">
          <span class="ic">{{ $it['icon'] }}</span> {{ $it['label'] }}
          <span class="tag-soon">soon</span>
        </a>
      @endforeach

      <a href="{{ route('admin.perangkat-desa.index') }}"
         class="{{ $is('admin/perangkat-desa*') ? 'is-active' : '' }}">
        <span class="ic">🏛️</span> Pemerintahan (Perangkat Desa)
      </a>

      <div class="nav-title">Link Cepat</div>

      <a href="{{ route('home') }}" target="_blank" rel="noopener">
        <span class="ic">🌐</span> Buka Website Publik
      </a>

      <a href="{{ route('pemerintahan') }}" target="_blank" rel="noopener">
        <span class="ic">👁️</span> Lihat Halaman Pemerintahan
      </a>
    </nav>

    <div class="side-footer">
      <div><b>Catatan:</b> Menu Profil Desa / Penduduk / UMKM / Wisata akan kita buat setelah admin dashboard & CRUD benar-benar rapi.</div>
      <div style="margin-top:6px;">Jika sidebar menutupi layar HP, pakai tombol ☰ di atas.</div>
    </div>
  </aside>

  {{-- MAIN --}}
  <main class="main">

    {{-- TOPBAR --}}
    <div class="topbar">
      <div style="display:flex; align-items:flex-start; gap:12px;">
        <a class="btn m-toggle" href="javascript:void(0)" id="admToggle" aria-label="Buka menu">
          ☰ Menu
        </a>

        <div>
          <p class="ttl">@yield('title', 'Admin')</p>
          <p class="sub">Kelola konten website profil desa untuk demo KKN.</p>
        </div>
      </div>

      <div class="top-actions">
        <a class="btn" href="{{ route('home') }}" target="_blank" rel="noopener">🌐 Publik</a>

        @if (Route::has('admin.perangkat-desa.create'))
          <a class="btn" href="{{ route('admin.perangkat-desa.create') }}">➕ Tambah Perangkat</a>
        @endif
      </div>
    </div>

    {{-- FLASH MESSAGE (KONSISTEN) --}}
    <div class="flash-wrap">
      @if (session('success'))
        <div class="flash ok">{{ session('success') }}</div>
      @endif

      @if (session('error'))
        <div class="flash err">{{ session('error') }}</div>
      @endif

      @if ($errors->any())
        <div class="flash err">
          <div style="font-weight:950;">Periksa input berikut:</div>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>

    {{-- PAGE CONTENT --}}
    <div style="margin-top:14px;">
      @yield('content')
    </div>

  </main>
</div>

<script>
(function(){
  const side = document.getElementById('admSide');
  const overlay = document.getElementById('admOverlay');
  const btn = document.getElementById('admToggle');

  const open = () => {
    if(!side || !overlay) return;
    side.classList.add('is-open');
    overlay.classList.add('is-show');
  };
  const close = () => {
    if(!side || !overlay) return;
    side.classList.remove('is-open');
    overlay.classList.remove('is-show');
  };

  if(btn) btn.addEventListener('click', open);
  if(overlay) overlay.addEventListener('click', close);

  // Close sidebar on ESC
  window.addEventListener('keydown', (e) => {
    if(e.key === 'Escape') close();
  });
})();
</script>

@stack('scripts')
</body>
</html>
