@extends('web.layouts.app')
@section('title','Beranda • Portal Desa Suriamedal')

@section('content')

<style>
/* =========================================================
   DESIGN SYSTEM — SMART VILLAGE
========================================================= */
:root{
  --green:#0f766e;
  --green-dark:#065f46;
  --accent:#facc15;
  --ink:#0f172a;
  --muted:#475569;
  --bg:#f8fafc;
  --card:#ffffff;
  --line:rgba(15,23,42,.12);
  --shadow-sm:0 8px 20px rgba(0,0,0,.08);
  --shadow:0 18px 45px rgba(0,0,0,.14);
  --radius:18px;
}

/* =========================================================
   GLOBAL ANIMATION
========================================================= */
.reveal{
  opacity:0;
  transform:translateY(40px);
  transition:opacity .9s ease, transform .9s ease;
}
.reveal.show{
  opacity:1;
  transform:none;
}

/* =========================================================
   HERO — SLIDER SMART VILLAGE
========================================================= */
.hero{
  position:relative;
  height:95vh;
  overflow:hidden;
  background:#000;
}

.hero-slide{
  position:absolute;
  inset:0;
  background-size:cover;
  background-position:center;
  opacity:0;
  transition:opacity 1.6s ease-in-out;
}
.hero-slide.active{ opacity:1 }

.hero::after{
  content:"";
  position:absolute;
  inset:0;
  background:
    linear-gradient(180deg,
      rgba(2,6,23,.55),
      rgba(2,6,23,.35)
    );
}

.hero-inner{
  position:relative;
  z-index:2;
  max-width:1200px;
  margin:auto;
  height:100%;
  display:flex;
  align-items:center;
  padding:0 24px;
  color:#fff;
}

.hero h1{
  font-size:56px;
  font-weight:900;
  margin-bottom:16px;
}

.hero p{
  max-width:720px;
  font-size:18px;
  line-height:1.8;
  margin-bottom:36px;
  color:#f1f5f9;
}

.hero-actions{
  display:flex;
  gap:14px;
  flex-wrap:wrap;
}

.btn{
  padding:14px 28px;
  border-radius:12px;
  font-weight:800;
  text-decoration:none;
  font-size:14px;
  transition:.3s ease;
}

.btn-primary{
  background:var(--accent);
  color:#14532d;
}
.btn-primary:hover{ transform:translateY(-2px) }

.btn-outline{
  border:2px solid #fff;
  color:#fff;
}
.btn-outline:hover{
  background:#fff;
  color:#0f172a;
}

/* =========================================================
   SECTION BASE
========================================================= */
.section{
  padding:120px 20px;
}
.section.alt{
  background:#fff;
}
.section-wrap{
  max-width:1200px;
  margin:auto;
}
.section-title{
  margin-bottom:56px;
}
.section-title h2{
  font-size:38px;
  margin-bottom:10px;
  font-weight:900;
}
.section-title p{
  color:var(--muted);
  max-width:760px;
  font-size:16px;
  line-height:1.7;
}

/* =========================================================
   JELAJAHI DESA — PROFESSIONAL GRID
========================================================= */
.explore{
  display:grid;
  grid-template-columns:1.1fr .9fr;
  gap:70px;
  align-items:center;
}

.explore-desc h3{
  font-size:40px;
  font-weight:900;
  margin-bottom:16px;
}

.explore-desc p{
  color:var(--muted);
  font-size:16px;
  line-height:1.8;
  max-width:520px;
}

.explore-highlight{
  margin-top:26px;
  padding-left:18px;
  border-left:4px solid var(--green);
  color:var(--green);
  font-weight:700;
}

.explore-grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:22px;
}

.explore-card{
  background:#fff;
  border-radius:var(--radius);
  padding:26px;
  box-shadow:var(--shadow-sm);
  text-align:center;
  transition:.35s ease;
  text-decoration:none;
  color:var(--ink);
}

.explore-card:hover{
  transform:translateY(-10px);
  box-shadow:var(--shadow);
}

.explore-icon{
  width:60px;
  height:60px;
  margin:0 auto 14px;
  border-radius:16px;
  background:#ecfdf5;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:26px;
}

.explore-card h4{
  font-size:16px;
  font-weight:800;
}
.explore-card span{
  font-size:13px;
  color:var(--muted);
}

/* =========================================================
   UMKM PREVIEW
========================================================= */
.umkm-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:30px;
}

.umkm-card{
  background:#fff;
  border-radius:20px;
  overflow:hidden;
  box-shadow:var(--shadow);
  transition:.35s ease;
}

.umkm-card:hover{ transform:translateY(-8px) }

.umkm-card img{
  width:100%;
  height:240px;
  object-fit:cover;
}

.umkm-body{
  padding:22px;
}

.umkm-body h4{
  font-size:17px;
  font-weight:800;
  margin-bottom:6px;
}

.umkm-body p{
  font-size:14px;
  color:var(--muted);
  line-height:1.6;
}

/* =========================================================
   RESPONSIVE
========================================================= */
@media(max-width:1000px){
  .explore{ grid-template-columns:1fr }
  .umkm-grid{ grid-template-columns:repeat(2,1fr) }
  .hero h1{ font-size:42px }
}
@media(max-width:600px){
  .umkm-grid{ grid-template-columns:1fr }
  .hero h1{ font-size:34px }
}
</style>

{{-- ================= HERO ================= --}}
<section class="hero">
  <div class="hero-slide active" style="background-image:url('{{ asset('images/slider/slide-1.jpg') }}')"></div>
  <div class="hero-slide" style="background-image:url('{{ asset('images/slider/slide-2.jpg') }}')"></div>
  <div class="hero-slide" style="background-image:url('{{ asset('images/slider/slide-3.jpg') }}')"></div>

  <div class="hero-inner reveal">
    <div>
      <h1>Desa Suriamedal</h1>
      <p>
        Website resmi Desa Suriamedal sebagai pusat informasi desa,
        publikasi kegiatan, potensi desa, serta dokumentasi pemerintahan
        yang mengusung konsep <b>Smart Village</b> melalui program KKN
        untuk mendukung transparansi dan pelayanan publik digital.
      </p>
      <div class="hero-actions">
        <a href="{{ route('profil') }}" class="btn btn-primary">Profil Desa</a>
        <a href="{{ route('wisata') }}" class="btn btn-outline">Wisata</a>
        <a href="{{ route('umkm') }}" class="btn btn-outline">UMKM</a>
      </div>
    </div>
  </div>
</section>

{{-- ================= JELAJAHI DESA ================= --}}
<section class="section alt reveal">
  <div class="section-wrap explore">
    <div class="explore-desc">
      <h3>Jelajahi Desa</h3>
      <p>
        Kenali Desa Suriamedal melalui layanan informasi terintegrasi
        yang dikembangkan sebagai bagian dari transformasi digital desa.
      </p>
      <div class="explore-highlight">
        Smart Village berbasis data, partisipasi, dan teknologi.
      </div>
    </div>

    <div class="explore-grid">
      <a href="{{ route('profil') }}" class="explore-card"><div class="explore-icon">🏛</div><h4>Profil Desa</h4><span>Identitas & sejarah</span></a>
      <a href="{{ route('data-penduduk') }}" class="explore-card"><div class="explore-icon">📊</div><h4>Data Penduduk</h4><span>Statistik resmi</span></a>
      <a href="{{ route('wisata') }}" class="explore-card"><div class="explore-icon">🌄</div><h4>Wisata</h4><span>Potensi alam</span></a>
      <a href="{{ route('umkm') }}" class="explore-card"><div class="explore-icon">🛍</div><h4>UMKM</h4><span>Ekonomi lokal</span></a>
      <a href="{{ route('peta-wilayah') }}" class="explore-card"><div class="explore-icon">🗺</div><h4>Peta Wilayah</h4><span>Lokasi desa</span></a>
      <a href="{{ route('pemerintahan') }}" class="explore-card"><div class="explore-icon">👥</div><h4>Aparatur</h4><span>Pemerintahan desa</span></a>
    </div>
  </div>
</section>

{{-- ================= UMKM PREVIEW ================= --}}
<section class="section reveal">
  <div class="section-wrap">
    <div class="section-title">
      <h2>UMKM Unggulan Desa</h2>
      <p>Produk hasil usaha masyarakat sebagai penggerak ekonomi lokal.</p>
    </div>

    <div class="umkm-grid">
      <div class="umkm-card">
        <img src="{{ asset('images/umkm/madu-lokal.jpg') }}">
        <div class="umkm-body">
          <h4>Madu Lokal</h4>
          <p>Produk madu alami hasil UMKM Desa Suriamedal.</p>
        </div>
      </div>

      <div class="umkm-card">
        <img src="{{ asset('images/umkm/olahan-pisang.jpg') }}">
        <div class="umkm-body">
          <h4>Olahan Pisang</h4>
          <p>Produk makanan khas desa dengan berbagai varian.</p>
        </div>
      </div>

      <div class="umkm-card">
        <img src="{{ asset('images/umkm/produk-desa.jpg') }}">
        <div class="umkm-body">
          <h4>Produk Desa</h4>
          <p>Beragam produk unggulan UMKM Desa Suriamedal.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/* HERO SLIDER */
const heroSlides = document.querySelectorAll('.hero-slide');
let idx = 0;
setInterval(()=>{
  heroSlides[idx].classList.remove('active');
  idx = (idx + 1) % heroSlides.length;
  heroSlides[idx].classList.add('active');
}, 6000);

/* SCROLL REVEAL */
const observer = new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting) e.target.classList.add('show');
  });
},{threshold:0.2});
document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));
</script>

@endsection
