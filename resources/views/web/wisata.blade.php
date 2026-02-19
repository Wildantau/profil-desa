@extends('web.layouts.app')
@section('title','Wisata Desa • Portal Desa Suriamedal')

@section('content')

<style>
/* =========================================================
   DESIGN SYSTEM – WISATA DESA (FINAL • DINAMIS)
========================================================= */
:root{
  --green:#0f766e;
  --green-dark:#065f46;
  --accent:#22c55e;

  --ink:#0f172a;
  --muted:#475569;

  --bg:#f8fafc;
  --card:#ffffff;
  --line:rgba(15,23,42,.10);

  --shadow-sm:0 14px 36px rgba(0,0,0,.12);
  --shadow-lg:0 34px 100px rgba(0,0,0,.30);

  --r16:16px;
  --r20:20px;
  --r28:28px;
}

/* =========================================================
   ANIMATION
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
   HERO
========================================================= */
.hero{
  position:relative;
  width:100%;
  overflow:hidden;
  background:#000;
}
.hero-media{
  aspect-ratio:16/7;
}
.hero-media img{
  width:100%;
  height:100%;
  object-fit:cover;
  filter:brightness(.6);
}
.hero-overlay{
  position:absolute;
  inset:0;
  background:linear-gradient(
    90deg,
    rgba(0,0,0,.75),
    rgba(0,0,0,.45),
    rgba(0,0,0,.15)
  );
}
.hero-content{
  position:absolute;
  inset:0;
  display:flex;
  align-items:center;
}
.hero-inner{
  max-width:1200px;
  margin:auto;
  padding:0 24px;
  color:#fff;
}
.hero-inner h1{
  font-size:clamp(36px,4.8vw,60px);
  font-weight:900;
  margin-bottom:16px;
}
.hero-inner p{
  max-width:720px;
  font-size:18px;
  line-height:1.7;
}

/* =========================================================
   SECTION
========================================================= */
.section{
  padding:110px 20px;
  background:var(--bg);
}
.section.alt{ background:#fff }
.wrap{
  max-width:1200px;
  margin:auto;
}
.section-title{
  margin-bottom:56px;
}
.section-title h2{
  font-size:34px;
  font-weight:900;
}
.section-title p{
  max-width:760px;
  color:var(--muted);
  line-height:1.8;
}

/* =========================================================
   GRID DESTINASI
========================================================= */
.grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:36px;
}
.card{
  background:var(--card);
  border-radius:var(--r28);
  overflow:hidden;
  box-shadow:var(--shadow-sm);
  transition:.35s ease;
}
.card:hover{
  transform:translateY(-12px);
  box-shadow:var(--shadow-lg);
}
.card img{
  width:100%;
  height:250px;
  object-fit:cover;
}
.card-body{
  padding:28px;
}
.card-body h4{
  font-size:20px;
  font-weight:800;
  margin-bottom:8px;
}
.card-body p{
  font-size:14px;
  color:var(--muted);
  line-height:1.7;
}
.card-body a{
  display:inline-flex;
  margin-top:14px;
  font-weight:800;
  font-size:14px;
  color:var(--green-dark);
  text-decoration:none;
}

/* =========================================================
   EMPTY STATE
========================================================= */
.empty{
  text-align:center;
  padding:80px 20px;
  color:var(--muted);
  font-size:16px;
}

/* =========================================================
   RESPONSIVE
========================================================= */
@media(max-width:1000px){
  .grid{ grid-template-columns:repeat(2,1fr) }
}
@media(max-width:600px){
  .hero-media{ aspect-ratio:4/3 }
  .grid{ grid-template-columns:1fr }
}
</style>

{{-- ================= HERO ================= --}}
<section class="hero">
  <div class="hero-media">
    <img src="{{ asset('images/wisata/bendungan-sadawarna-1.jpg') }}">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="hero-inner reveal">
        <h1>Wisata Desa Suriamedal</h1>
        <p>
          Destinasi wisata alam dan rekreasi desa
          sebagai penggerak ekonomi lokal dan edukasi masyarakat.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ================= DESKRIPSI ================= --}}
<section class="section alt">
  <div class="wrap section-title reveal">
    <h2>Potensi Wisata Desa</h2>
    <p>
      Seluruh destinasi berikut dikelola oleh pemerintah desa
      dan ditampilkan otomatis dari panel admin.
    </p>
  </div>
</section>

{{-- ================= DESTINASI DINAMIS ================= --}}
<section class="section">
  <div class="wrap">

    @if($wisata->isEmpty())
      <div class="empty">
        Belum ada data wisata yang dipublikasikan.
      </div>
    @else
      <div class="grid">
        @foreach($wisata as $item)
          <div class="card reveal">
            <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}">
            <div class="card-body">
              <h4>{{ $item->nama }}</h4>
              <p>{{ Str::limit($item->deskripsi, 120) }}</p>
              @if($item->lokasi)
                <a target="_blank"
                   href="https://www.google.com/maps/search/{{ urlencode($item->lokasi) }}">
                  📍 Lihat di Google Maps
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif

  </div>
</section>

<script>
/* REVEAL */
const io = new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.classList.add('show');
      io.unobserve(e.target);
    }
  });
},{threshold:.15});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>

@endsection
