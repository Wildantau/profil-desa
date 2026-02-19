<header class="site-header">
  <div class="container">
    <div class="brand">
      <b>Portal Desa Suriamedal</b>
      <small>Website Resmi Pemerintah Desa</small>
    </div>

    <nav class="nav-public">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

      <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
        Profil Desa
      </a>

      <a href="{{ route('data-penduduk') }}" class="{{ request()->routeIs('data-penduduk') ? 'active' : '' }}">
        Data Penduduk
      </a>

      <a href="{{ route('pemerintahan') }}" class="{{ request()->routeIs('pemerintahan') ? 'active' : '' }}">
        Pemerintahan
      </a>

      <a href="{{ route('wisata') }}" class="{{ request()->routeIs('wisata') ? 'active' : '' }}">
        Wisata
      </a>

      <a href="{{ route('umkm') }}" class="{{ request()->routeIs('umkm') ? 'active' : '' }}">
        UMKM
      </a>

      <!-- 🔥 INI YANG KAMU CARI -->
      <a href="{{ route('peta-wilayah') }}" class="{{ request()->routeIs('peta-wilayah') ? 'active' : '' }}">
        Peta Wilayah
      </a>

      <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">
        Kontak
      </a>
    </nav>
  </div>
</header>
