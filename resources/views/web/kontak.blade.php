@extends('web.layouts.app')
@section('title','Kontak • Portal Desa Suriamedal')

@section('content')

<style>
  :root{
    --ink:#0f172a;
    --muted:#64748b;
    --line:rgba(15,23,42,.10);

    --g1: rgba(96,165,250,.18);
    --g2: rgba(34,197,94,.16);
    --g3: rgba(168,85,247,.14);

    --card: rgba(255,255,255,.94);
    --shadow: 0 18px 45px rgba(2,6,23,.08);
    --shadow2: 0 10px 28px rgba(2,6,23,.06);

    --r16:16px;
    --r20:20px;
    --r24:24px;
  }

  .ct-wrap{
    width:100%;
    padding:46px 0 78px;
    background:
      radial-gradient(900px 460px at 12% 0%, var(--g1), transparent 60%),
      radial-gradient(900px 460px at 88% 10%, var(--g2), transparent 55%),
      radial-gradient(900px 520px at 50% 100%, var(--g3), transparent 55%),
      linear-gradient(180deg, #f6f9ff, #f7fff8);
  }
  .container-max{ max-width:1200px; margin:0 auto; padding:0 16px; }

  /* HERO */
  .hero{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    padding:22px;
    backdrop-filter: blur(10px);
    position:relative;
    overflow:hidden;
  }
  .hero::before{
    content:"";
    position:absolute; inset:-60px -40px auto auto;
    width:260px; height:260px;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.22), transparent 60%),
      radial-gradient(circle at 70% 70%, rgba(96,165,250,.22), transparent 60%);
    transform: rotate(18deg);
    pointer-events:none;
  }
  .hero-title{
    margin:0;
    font-size:36px;
    font-weight:950;
    letter-spacing:-0.03em;
    color:var(--ink);
  }
  @media(max-width:768px){ .hero-title{ font-size:28px; } }
  .hero-sub{
    margin-top:10px;
    color:var(--muted);
    line-height:1.75;
    max-width:820px;
  }

  /* GRID */
  .grid{
    margin-top:22px;
    display:grid;
    grid-template-columns:1fr;
    gap:16px;
  }
  @media(min-width:900px){
    .grid{ grid-template-columns: 1.2fr .8fr; gap:22px; }
  }

  /* CARD */
  .card{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow2);
    padding:22px;
    transition:.18s ease;
  }
  .card:hover{
    transform: translateY(-3px);
    box-shadow: 0 22px 48px rgba(2,6,23,.12);
  }

  .label{
    font-size:12px;
    font-weight:900;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:#065f46;
  }
  .value{
    margin-top:6px;
    font-size:16px;
    font-weight:900;
    color:var(--ink);
    line-height:1.6;
  }
  .muted{
    margin-top:6px;
    font-size:14px;
    color:var(--muted);
    line-height:1.7;
  }

  .item{
    display:flex;
    gap:16px;
    align-items:flex-start;
  }
  .icon{
    width:46px;
    height:46px;
    border-radius:14px;
    background: linear-gradient(135deg, rgba(34,197,94,.20), rgba(96,165,250,.18));
    display:flex;
    align-items:center;
    justify-content:center;
    flex:0 0 auto;
    box-shadow: 0 8px 22px rgba(2,6,23,.10);
  }
  .icon svg{
    width:22px;
    height:22px;
    color:#065f46;
  }

  /* ACTION */
  .action{
    margin-top:18px;
    display:flex;
    flex-wrap:wrap;
    gap:10px;
  }
  .btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    border-radius:14px;
    font-weight:900;
    font-size:14px;
    text-decoration:none;
    transition:.18s ease;
    border:1px solid rgba(16,185,129,.30);
    background: rgba(16,185,129,.12);
    color:#065f46;
  }
  .btn:hover{
    background: rgba(16,185,129,.18);
    transform: translateY(-1px);
  }

  /* REVEAL */
  .reveal{
    opacity:0;
    transform: translateY(14px);
    filter: blur(2px);
    transition: opacity .7s ease, transform .7s ease, filter .7s ease;
  }
  .reveal.is-in{
    opacity:1;
    transform:none;
    filter:none;
  }
</style>

<div class="ct-wrap">
  <div class="container-max">

    {{-- HERO --}}
    <div class="hero reveal">
      <h1 class="hero-title">Kontak Desa</h1>
      <p class="hero-sub">
        Informasi resmi untuk keperluan komunikasi, pelayanan masyarakat,
        serta koordinasi dengan Pemerintah Desa Suriamedal.
      </p>
    </div>

    <div class="grid">

      {{-- INFORMASI --}}
      <div class="card reveal">

        <div class="item">
          <div class="icon">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 2C8 6 4 8 4 13a8 8 0 0 0 16 0c0-5-4-7-8-11Z"
                    stroke="currentColor" stroke-width="2"/>
            </svg>
          </div>
          <div>
            <div class="label">Alamat Kantor Desa</div>
            <div class="value">
              Suriamedal, Kec. Surian,<br>
              Kabupaten Sumedang, Jawa Barat 45393
            </div>
            <div class="muted">
              Digunakan sebagai alamat resmi administrasi dan pelayanan publik.
            </div>
          </div>
        </div>

        <div style="height:22px;"></div>

        <div class="item">
          <div class="icon">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M22 16.9v3a2 2 0 0 1-2.2 2
                       A19.8 19.8 0 0 1 3 5.2
                       2 2 0 0 1 5 3h3
                       a2 2 0 0 1 2 1.7
                       c.1.9.3 1.7.6 2.6
                       a2 2 0 0 1-.5 2.1L9 10
                       a16 16 0 0 0 5 5l.6-.6
                       a2 2 0 0 1 2.1-.5
                       c.9.3 1.7.5 2.6.6
                       a2 2 0 0 1 1.7 2Z"
                    stroke="currentColor" stroke-width="2"/>
            </svg>
          </div>
          <div>
            <div class="label">Telepon</div>
            <div class="value">0813-2073-1282</div>
            <div class="muted">
              Dapat dihubungi pada jam kerja kantor desa.
            </div>
          </div>
        </div>

        <div class="action">
          <a class="btn" href="tel:081320731282">Hubungi via Telepon</a>
          <a class="btn" target="_blank"
             href="https://www.google.com/maps/search/?api=1&query=Suriamedal+Surian+Sumedang">
            Lihat di Google Maps
          </a>
        </div>

      </div>

      {{-- CATATAN RESMI --}}
      <div class="card reveal">
        <div class="label">Keterangan</div>
        <p class="muted" style="margin-top:10px;">
          Informasi kontak ini bersifat resmi dan ditampilkan
          untuk mendukung transparansi, keterbukaan informasi publik,
          serta kemudahan masyarakat dalam mengakses layanan desa.
        </p>
        <p class="muted">
          Data dapat diperbarui sewaktu-waktu sesuai kebijakan Pemerintah Desa.
        </p>
      </div>

    </div>

  </div>
</div>

<script>
(function(){
  const els = document.querySelectorAll('.reveal');
  if(!('IntersectionObserver' in window)){
    els.forEach(el=>el.classList.add('is-in'));
    return;
  }
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting){
        e.target.classList.add('is-in');
        io.unobserve(e.target);
      }
    });
  }, {threshold:.12});
  els.forEach(el=>io.observe(el));
})();
</script>

@endsection
