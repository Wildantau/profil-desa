@extends('web.layouts.app')
@section('title','UMKM Desa • Portal Desa Suriamedal')

@section('content')

@php use Illuminate\Support\Str; @endphp

<style>
/* =========================================================
   DESIGN SYSTEM — KONSISTEN DENGAN WISATA
========================================================= */
:root{
  --primary:#0f766e;
  --primary-dark:#065f46;
  --accent:#facc15;

  --ink:#0f172a;
  --muted:#475569;

  --bg:#f8fafc;
  --card:#ffffff;

  --shadow-sm:0 12px 30px rgba(0,0,0,.12);
  --shadow-lg:0 40px 90px rgba(0,0,0,.30);

  --r20:20px;
  --r28:28px;
}

/* HERO */
.hero-umkm{
  position:relative;
  height:100vh;
  padding-top:120px;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  color:#fff;
  background:
    linear-gradient(
      180deg,
      rgba(0,0,0,.70),
      rgba(0,0,0,.55),
      rgba(0,0,0,.35)
    ),
    url('{{ asset('images/umkm/umkm-hero.jpg') }}') center/cover no-repeat;
}

.hero-umkm h1{
  font-size:clamp(38px,6vw,64px);
  font-weight:900;
  margin-bottom:18px;
}

.hero-umkm p{
  max-width:820px;
  margin:auto;
  font-size:18px;
  line-height:1.8;
  opacity:.95;
}

.hero-cta{
  margin-top:34px;
  display:flex;
  gap:16px;
  justify-content:center;
  flex-wrap:wrap;
}

.hero-cta a{
  padding:14px 32px;
  border-radius:999px;
  font-weight:800;
  font-size:15px;
  text-decoration:none;
}

.hero-cta .primary{
  background:var(--accent);
  color:#1f2937;
}

.hero-cta .outline{
  border:2px solid rgba(255,255,255,.8);
  color:#fff;
}

/* SECTION */
.section{
  padding:100px 20px;
  background:var(--bg);
}
.section.white{ background:#fff; }

.wrap{
  max-width:1200px;
  margin:auto;
}

.section-title{
  margin-bottom:56px;
}
.section-title h2{
  font-size:36px;
  font-weight:900;
  margin-bottom:10px;
}
.section-title p{
  color:var(--muted);
  max-width:760px;
  line-height:1.8;
}

/* GRID PRODUK */
.umkm-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:36px;
}

.umkm-card{
  background:#fff;
  border-radius:var(--r28);
  overflow:hidden;
  box-shadow:var(--shadow-sm);
  transition:.35s ease;
}

.umkm-card:hover{
  transform:translateY(-12px);
  box-shadow:var(--shadow-lg);
}

.umkm-media{
  height:260px;
}
.umkm-media img{
  width:100%;
  height:100%;
  object-fit:cover;
}

.umkm-body{
  padding:28px;
}
.umkm-body h4{
  font-size:20px;
  font-weight:800;
  margin-bottom:8px;
}
.umkm-body p{
  color:var(--muted);
  font-size:15px;
  line-height:1.7;
  margin-bottom:20px;
}
.umkm-body a{
  display:inline-flex;
  padding:12px 26px;
  background:var(--primary);
  color:#fff;
  border-radius:999px;
  font-size:14px;
  font-weight:800;
  text-decoration:none;
}

/* EMPTY */
.empty{
  grid-column:1/-1;
  text-align:center;
  color:var(--muted);
  font-size:16px;
  padding:60px 0;
}

/* RESPONSIVE */
@media(max-width:1100px){
  .umkm-grid{ grid-template-columns:repeat(2,1fr) }
}
@media(max-width:640px){
  .umkm-grid{ grid-template-columns:1fr }
  .section{ padding:80px 18px }
  .hero-umkm p{ font-size:16px }
}
</style>


{{-- ================= HERO ================= --}}
<section class="hero-umkm">
  <div>
    <h1>UMKM Desa Suriamedal</h1>
    <p>
      Produk unggulan hasil usaha masyarakat Desa Suriamedal
      sebagai pilar penggerak ekonomi lokal yang mandiri dan berkelanjutan.
    </p>

    <div class="hero-cta">
      <a href="#produk" class="primary">Lihat Produk</a>
      <a href="#galeri" class="outline">Galeri UMKM</a>
    </div>
  </div>
</section>


{{-- ================= PRODUK DINAMIS ================= --}}
<section id="produk" class="section">
  <div class="wrap">

    <div class="section-title">
      <h2>Produk Unggulan Desa</h2>
      <p>
        UMKM Desa Suriamedal dikembangkan dengan kualitas,
        inovasi, dan identitas lokal.
      </p>
    </div>

    <div class="umkm-grid">

      @forelse($umkm as $item)
        <div class="umkm-card">

          <div class="umkm-media">
            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_usaha }}">
          </div>

          <div class="umkm-body">
            <h4>{{ $item->nama_usaha }}</h4>

            <p>
              {{ Str::limit($item->deskripsi, 100) }}
            </p>

            <a href="{{ route('umkm.show', $item->id) }}">
              Detail Produk
            </a>
          </div>

        </div>
      @empty

        <div class="empty">
          Belum ada UMKM yang ditampilkan saat ini.
        </div>

      @endforelse

    </div>

  </div>
</section>


{{-- ================= GALERI (STATIS OPTIONAL) ================= --}}
<section id="galeri" class="section white">
  <div class="wrap">

    <div class="section-title">
      <h2>Galeri UMKM</h2>
      <p>Dokumentasi aktivitas dan produk UMKM Desa Suriamedal.</p>
    </div>

    <div class="gallery">
      <img src="{{ asset('images/umkm/galeri-1.jpeg') }}">
      <img src="{{ asset('images/umkm/galeri-2.jpeg') }}">
      <img src="{{ asset('images/umkm/galeri-3.jpeg') }}">
      <img src="{{ asset('images/umkm/galeri-4.jpeg') }}">
    </div>

  </div>
</section>

@endsection
