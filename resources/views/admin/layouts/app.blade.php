<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Dashboard Admin • Portal Desa')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    :root{
      --bg:#f1f5f9;
      --ink:#0f172a;
      --muted:#64748b;
      --line:rgba(15,23,42,.12);
      --primary:#0f766e;
      --primary-dark:#065f46;
      --card:#ffffff;
      --shadow:0 12px 32px rgba(2,6,23,.08);
    }

    *{ box-sizing:border-box }

    body.admin-panel{
      margin:0;
      font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;
      background:var(--bg);
      color:var(--ink);
    }

    /* ================= HEADER ================= */
    header{
      background:linear-gradient(90deg,#020617,#020617);
      color:#fff;
      padding:14px 28px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      position:sticky;
      top:0;
      z-index:100;
      box-shadow:0 6px 20px rgba(2,6,23,.4);
    }

    header .brand{
      display:flex;
      align-items:center;
      gap:12px;
      font-weight:900;
      letter-spacing:.3px;
      font-size:16px;
    }

    header .brand span{
      width:36px;
      height:36px;
      border-radius:10px;
      background:linear-gradient(135deg,#10b981,#3b82f6);
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:900;
    }

    nav{
      display:flex;
      align-items:center;
      gap:18px;
      flex-wrap:wrap;
    }

    nav a{
      color:#e5e7eb;
      text-decoration:none;
      font-weight:600;
      font-size:14px;
      position:relative;
    }

    nav a::after{
      content:"";
      position:absolute;
      left:0;
      bottom:-6px;
      width:0;
      height:2px;
      background:#10b981;
      transition:.25s;
    }

    nav a:hover{
      color:#ffffff;
    }

    nav a:hover::after{
      width:100%;
    }

    /* ================= MAIN ================= */
    main{
      max-width:1280px;
      margin:0 auto;
      padding:36px 28px 80px;
      min-height:75vh;
    }

    /* ================= FOOTER ================= */
    footer{
      background:#020617;
      color:#94a3b8;
      padding:16px;
      text-align:center;
      font-size:13px;
    }

    /* ================= CARD DEFAULT ================= */
    .card{
      background:var(--card);
      border-radius:18px;
      box-shadow:var(--shadow);
      padding:28px;
      border:1px solid var(--line);
    }

    /* ================= UTIL ================= */
    .muted{ color:var(--muted) }
  </style>

  {{-- CSS KHUSUS HALAMAN --}}
  @stack('styles')
</head>

<body class="admin-panel">

<header>
  <div class="brand">
    <span>D</span>
    <b>Dashboard Admin Desa</b>
  </div>

  <nav>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.perangkat-desa.index') }}">Perangkat</a>
    <a href="{{ route('admin.statistik-penduduk.index') }}">Statistik</a>
    <a href="{{ route('admin.profil-desa.edit') }}">Profil Desa</a>
    <a href="{{ route('admin.wisata.index') }}">Wisata</a>
    <a href="{{ route('admin.umkm.index') }}">UMKM</a>
    <a href="{{ route('home') }}" target="_blank">Lihat Publik</a>
  </nav>
</header>

<main>
  {{-- 🔥 INI YANG TADI JADI SUMBER MASALAH --}}
  @yield('content')
</main>

<footer>
  © {{ date('Y') }} Sistem Informasi Desa • KKN
</footer>

{{-- JS KHUSUS HALAMAN --}}
@stack('scripts')

</body>
</html>
