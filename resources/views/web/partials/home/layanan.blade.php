<section class="section layanan">
    <div class="container">
        <h2>Layanan & Informasi Desa</h2>
        <p class="section-desc">
            Portal ini dirancang untuk mendukung transparansi dan kemudahan akses informasi desa.
        </p>

        <div class="grid-4">
            <div class="card">
                <h3>Profil Desa</h3>
                <p>Informasi umum, sejarah, visi & misi desa.</p>
                <a href="{{ route('profil') }}">Lihat Profil →</a>
            </div>

            <div class="card">
                <h3>Data Penduduk</h3>
                <p>Statistik penduduk untuk kebutuhan layanan publik.</p>
                <a href="{{ route('data-penduduk') }}">Lihat Data →</a>
            </div>

            <div class="card">
                <h3>Peta Wilayah</h3>
                <p>Informasi geografis dan batas wilayah desa.</p>
                <a href="{{ route('peta-wilayah') }}">Buka Peta →</a>
            </div>

            <div class="card">
                <h3>Pemerintahan</h3>
                <p>Struktur dan perangkat pemerintahan desa.</p>
                <a href="{{ route('pemerintahan') }}">Lihat Struktur →</a>
            </div>
        </div>
    </div>
</section>
