<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>@yield('title','Portal Desa Suriamedal')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
:root{
  --primary:#047857;
  --primary-dark:#065f46;
  --accent:#10b981;
  --ink:#0f172a;
  --muted:#64748b;
  --bg:#f8fafc;
  --line:rgba(15,23,42,.08);
  --radius:16px;
  --shadow:0 15px 40px rgba(2,6,23,.08);
}

*{box-sizing:border-box}

body{
  margin:0;
  font-family:'Inter',system-ui,-apple-system;
  color:var(--ink);
  background:#ffffff;
  line-height:1.65;
  -webkit-font-smoothing:antialiased;
}

a{text-decoration:none;color:inherit}

/* ================= HEADER ================= */

header{
  position:sticky;
  top:0;
  z-index:100;
  background:linear-gradient(90deg,var(--primary),var(--primary-dark));
  box-shadow:0 12px 30px rgba(0,0,0,.18);
}

.nav-wrap{
  max-width:1200px;
  margin:auto;
  padding:14px 20px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:20px;
}

/* BRAND */

.brand{
  display:flex;
  align-items:center;
  gap:14px;
  color:#fff;
}

.logo{
  width:58px;
  height:58px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  overflow:hidden;
}

.logo img{
  width:48px;
  object-fit:contain;
  filter:drop-shadow(0 4px 10px rgba(0,0,0,.35));
}

.brand-text b{
  display:block;
  font-size:18px;
  font-weight:900;
  letter-spacing:.2px;
}

.brand-text small{
  display:block;
  font-size:12px;
  opacity:.85;
  margin-top:2px;
}

/* NAVIGATION */

nav{
  display:flex;
  gap:20px;
  align-items:center;
}

nav a{
  color:#e5e7eb;
  font-weight:600;
  font-size:14px;
  padding:6px 0;
  position:relative;
  transition:.25s ease;
}

nav a:hover{color:#ffffff}

nav a.active{
  color:#ffffff;
  font-weight:800;
}

nav a.active::after{
  content:"";
  position:absolute;
  left:0;
  right:0;
  bottom:-6px;
  height:3px;
  border-radius:3px;
  background:var(--accent);
}

/* ================= MAIN ================= */

main{
  min-height:75vh;
  background:#ffffff;
}

/* ================= FOOTER ================= */

footer{
  background:#022c22;
  color:#cbd5e1;
  margin-top:80px;
}

.footer-wrap{
  max-width:1200px;
  margin:auto;
  padding:50px 20px;
  display:grid;
  grid-template-columns:2fr 1fr 1fr;
  gap:40px;
}

.footer-wrap h4{
  margin:0 0 12px;
  font-size:15px;
  font-weight:800;
  color:#ecfeff;
}

.footer-wrap p,
.footer-wrap a{
  font-size:14px;
  line-height:1.7;
  color:#cbd5e1;
}

.footer-wrap a:hover{color:#ffffff}

.footer-bottom{
  border-top:1px solid rgba(255,255,255,.12);
  text-align:center;
  padding:16px;
  font-size:13px;
  opacity:.85;
}

/* ================= RESPONSIVE ================= */

.menu-toggle{
  display:none;
  font-size:22px;
  color:#fff;
  cursor:pointer;
}

@media(max-width:900px){

  nav{
    position:absolute;
    top:100%;
    left:0;
    right:0;
    background:var(--primary-dark);
    flex-direction:column;
    gap:14px;
    padding:20px;
    display:none;
  }

  nav.show{display:flex}

  .menu-toggle{display:block}

  .footer-wrap{
    grid-template-columns:1fr;
  }
}
</style>

@stack('styles')
</head>

<body>

<header>
  <div class="nav-wrap">

    <a href="{{ route('home') }}" class="brand">
      <div class="logo">
        <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa Suriamedal">
      </div>
      <div class="brand-text">
        <b>Portal Desa Suriamedal</b>
        <small>Website Resmi Pemerintah Desa</small>
      </div>
    </a>

    <div class="menu-toggle" onclick="toggleMenu()">☰</div>

    <nav id="navMenu">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home')?'active':'' }}">Home</a>
      <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil')?'active':'' }}">Profil Desa</a>
      <a href="{{ route('data-penduduk') }}" class="{{ request()->routeIs('data-penduduk')?'active':'' }}">Data Penduduk</a>
      <a href="{{ route('pemerintahan') }}" class="{{ request()->routeIs('pemerintahan')?'active':'' }}">Pemerintahan</a>
      <a href="{{ route('peta-wilayah') }}" class="{{ request()->routeIs('peta-wilayah')?'active':'' }}">Peta Wilayah</a>
      <a href="{{ route('wisata') }}" class="{{ request()->routeIs('wisata')?'active':'' }}">Wisata</a>
      <a href="{{ route('umkm') }}" class="{{ request()->routeIs('umkm')?'active':'' }}">UMKM</a>
      <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak')?'active':'' }}">Kontak</a>
    </nav>

  </div>
</header>

<main>
  @yield('content')
</main>

<footer>
  <div class="footer-wrap">
    <div>
      <h4>Portal Desa Suriamedal</h4>
      <p>
        Website resmi Pemerintah Desa Suriamedal sebagai media informasi,
        dokumentasi, dan publikasi digital desa.
      </p>
    </div>

    <div>
      <h4>Navigasi</h4>
      <a href="{{ route('profil') }}">Profil Desa</a><br>
      <a href="{{ route('data-penduduk') }}">Data Penduduk</a><br>
      <a href="{{ route('peta-wilayah') }}">Peta Wilayah</a><br>
      <a href="{{ route('wisata') }}">Wisata</a>
    </div>

    <div>
      <h4>Kontak</h4>
      <p>Kantor Desa Suriamedal</p>
      <p>Kabupaten Sumedang</p>
    </div>
  </div>

  <div class="footer-bottom">
    © {{ date('Y') }} Pemerintah Desa Suriamedal. All rights reserved.
  </div>
</footer>

<script>
function toggleMenu(){
  document.getElementById('navMenu').classList.toggle('show');
}
</script>

@stack('scripts')
</body>
</html>
