@extends('web.layouts.app')
@section('title','Pemerintahan • Portal Desa Suriamedal')

@section('content')

<style>
  :root{
    --ink:#0f172a;
    --muted:#64748b;
    --line:rgba(15,23,42,.10);

    --g1: rgba(96,165,250,.18);
    --g2: rgba(34,197,94,.16);
    --g3: rgba(168,85,247,.14);

    --card: rgba(255,255,255,.92);
    --shadow: 0 18px 45px rgba(2,6,23,.08);
    --shadow2: 0 10px 28px rgba(2,6,23,.06);

    --r16:16px;
    --r20:20px;
    --r24:24px;
  }

  .gov-wrap{
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
    padding:18px;
    backdrop-filter: blur(10px);
    overflow:hidden;
    position:relative;
  }
  .hero::before{
    content:"";
    position:absolute; inset:-70px -50px auto auto;
    width:290px; height:290px;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.22), transparent 60%),
      radial-gradient(circle at 70% 70%, rgba(96,165,250,.22), transparent 60%),
      radial-gradient(circle at 50% 50%, rgba(168,85,247,.16), transparent 60%);
    filter: blur(2px);
    transform: rotate(18deg);
    pointer-events:none;
  }
  .hero-top{ display:flex; gap:14px; align-items:center; justify-content:space-between; flex-wrap:wrap; }
  .brand{ display:flex; gap:12px; align-items:center; }
  .mark{
    width:56px; height:56px; border-radius:18px;
    border:1px solid rgba(15,23,42,.12);
    background: linear-gradient(135deg, rgba(34,197,94,.22), rgba(96,165,250,.20), rgba(168,85,247,.16));
    box-shadow: 0 12px 26px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
    flex:0 0 auto;
  }
  .mark svg{ width:26px; height:26px; color: var(--ink); }

  .hero-title{
    margin:0;
    font-size:36px;
    line-height:1.08;
    letter-spacing:-0.035em;
    font-weight:950;
    color:var(--ink);
  }
  @media(max-width:768px){ .hero-title{ font-size:28px; } }
  .hero-sub{
    margin:8px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.8;
    max-width:920px;
  }

  /* ORG WRAP */
  .org{
    margin-top:14px;
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .org-pad{ padding:18px; }
  @media(min-width:768px){ .org-pad{ padding:24px; } }

  /* PEJABAT CARD */
  .p-card{
    border-radius: 24px;
    border: 1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.95);
    box-shadow: 0 12px 28px rgba(2,6,23,.06);
    overflow:hidden;
    transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    position:relative;
    width:100%;
  }
  .p-card::before{
    content:"";
    position:absolute; inset:0;
    background:
      radial-gradient(520px 220px at 12% 0%, rgba(96,165,250,.11), transparent 62%),
      radial-gradient(520px 220px at 88% 0%, rgba(34,197,94,.11), transparent 62%);
    opacity:.95;
    pointer-events:none;
  }
  .p-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 22px 52px rgba(2,6,23,.12);
    border-color: rgba(16,185,129,.28);
  }
  .p-in{ position:relative; padding:18px; text-align:center; }
  @media(min-width:768px){ .p-in{ padding:22px; } }

  .p-avatar{
    width:122px; height:122px;
    margin:0 auto;
    border-radius:28px;
    overflow:hidden;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.94);
    box-shadow: 0 12px 26px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
  }
  @media(min-width:768px){
    .p-avatar{ width:154px; height:154px; border-radius:32px; }
  }
  .p-avatar img{ width:100%; height:100%; object-fit:cover; object-position:50% 18%; display:block; }
  .p-avatar .fallback{ font-size:54px; opacity:.92; }

  .p-role{
    margin-top:14px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:8px 14px;
    border-radius:999px;
    border:1px solid rgba(16,185,129,.22);
    background: rgba(16,185,129,.10);
    color:#065f46;
    font-weight:950;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:12px;
    white-space:nowrap;
  }
  .p-name{
    margin-top:10px;
    font-size:20px;
    font-weight:950;
    letter-spacing:-.02em;
    color:var(--ink);
    line-height:1.2;
    word-break: break-word;
  }
  @media(min-width:768px){ .p-name{ font-size:24px; } }
  .p-sub{
    margin-top:8px;
    color:var(--muted);
    font-size:13px;
    line-height:1.75;
  }

  /* CONNECTOR LINES */
  .line{
    width:3px;
    height:44px;
    margin:18px auto;
    border-radius:999px;
    background: linear-gradient(180deg, rgba(148,163,184,.18), rgba(148,163,184,.60), rgba(148,163,184,.18));
  }
  .line.big{ height:56px; margin:20px auto; }
  .hline{
    height:3px;
    border-radius:999px;
    background: linear-gradient(90deg, rgba(148,163,184,.10), rgba(148,163,184,.58), rgba(148,163,184,.10));
    margin: 18px 0 22px;
    display:none;
  }
  @media(min-width: 900px){ .hline{ display:block; } }

  /* SECTION DIVIDER */
  .section-wrap{
    position:relative;
    margin: 60px 0 22px;
    text-align:center;
  }
  .section-wrap::before{
    content:"";
    position:absolute;
    top:50%;
    left:0;
    right:0;
    height:1px;
    background: linear-gradient(90deg, transparent, rgba(148,163,184,.62), transparent);
  }
  .section-title{
    position:relative;
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:10px 24px;
    border-radius:999px;
    background: rgba(255,255,255,.97);
    border:1px solid rgba(148,163,184,.35);
    box-shadow: 0 12px 30px rgba(2,6,23,.10);
    font-size:13px;
    font-weight:950;
    letter-spacing:.16em;
    text-transform:uppercase;
    color:#065f46;
    z-index:2;
  }
  .section-title::before{
    content:"";
    width:9px;
    height:9px;
    border-radius:999px;
    background: linear-gradient(135deg, rgba(16,185,129,.95), rgba(56,189,248,.95));
    box-shadow:0 0 0 4px rgba(16,185,129,.15);
  }

  /* GRID */
  .grid-3{ display:grid; grid-template-columns:1fr; gap:14px; }
  @media(min-width: 900px){ .grid-3{ grid-template-columns: repeat(3, minmax(0,1fr)); gap:18px; } }

  .grid-2{ display:grid; grid-template-columns:1fr; gap:14px; }
  @media(min-width: 900px){ .grid-2{ grid-template-columns: repeat(2, minmax(0,1fr)); gap:20px; } }

  .max-1{ max-width: 700px; margin:0 auto; }
  .max-5{ max-width: 1120px; margin:0 auto; }

  /* REVEAL */
  .reveal{
    opacity:0;
    transform: translateY(16px);
    filter: blur(2px);
    transition: opacity .75s cubic-bezier(.2,.8,.2,1),
                transform .75s cubic-bezier(.2,.8,.2,1),
                filter .75s cubic-bezier(.2,.8,.2,1);
    will-change: opacity, transform, filter;
  }
  .reveal.is-in{
    opacity:1;
    transform: translateY(0);
    filter: blur(0);
  }

  @media (prefers-reduced-motion: reduce){
    .reveal{ opacity:1; transform:none; filter:none; transition:none; }
    .p-card{ transition:none; }
    .p-card:hover{ transform:none; }
  }
</style>

@php
  /**
   * fotoUrl: dukung path lokal & URL (data lama aman)
   */
  function fotoUrl($path) {
    $path = is_string($path) ? trim($path) : '';
    if ($path === '') return null;

    // URL langsung
    if (preg_match('~^https?://~i', $path)) return $path;

    // path lokal
    return asset(ltrim($path, '/'));
  }

  /**
   * Helper card pejabat (tetap gaya kamu)
   */
  function pejabat($item) {
    $jabatan = $item->jabatan ?? 'Jabatan';
    $nama    = $item->nama ?? '_____';
    $nama    = trim($nama) !== '' ? $nama : '_____';

    $fotoRel = $item->foto ?? null; // contoh: images/pemerintahan/kepala-desa.png atau https://...
    $img     = $fotoRel ? fotoUrl($fotoRel) : null;

    return '
      <div class="p-card reveal">
        <div class="p-in">
          <div class="p-avatar" aria-hidden="true">
            '.($img ? '
              <img src="'.$img.'" alt="'.$jabatan.'"
                   onerror="this.remove(); this.parentElement.innerHTML = \'<span class=&quot;fallback&quot;>👤</span>\';">
            ' : '<span class="fallback">👤</span>').'
          </div>

          <div class="p-role">'.$jabatan.'</div>
          <div class="p-name">'.$nama.'</div>
        </div>
      </div>
    ';
  }
@endphp

<div class="gov-wrap">
  <div class="container-max">

    {{-- HERO --}}
    <div class="hero reveal">
      <div class="hero-top">
        <div class="brand">
          <div class="mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 3l8 4v6c0 5-3.5 8-8 8s-8-3-8-8V7l8-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              <path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h1 class="hero-title">Pemerintah Desa Suriamedal</h1>
            <p class="hero-sub">
              Struktur organisasi perangkat desa ditampilkan secara rapi dan profesional untuk mendukung informasi publik,
              dokumentasi, serta presentasi kepada masyarakat.
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- ORG --}}
    <div class="org reveal" style="margin-top:14px;">
      <div class="org-pad">

        {{-- KEPALA DESA --}}
        @php $kepala = ($data['kepala_desa'] ?? collect()); @endphp
        @if($kepala->count())
          @foreach($kepala as $item)
            <div class="max-1">{!! pejabat($item) !!}</div>
          @endforeach
        @else
          <div class="max-1">{!! pejabat((object)['jabatan'=>'Kepala Desa','nama'=>'_____','foto'=>null]) !!}</div>
        @endif

        <div class="line"></div>

        {{-- SEKRETARIS --}}
        @php $sekdes = ($data['sekretaris'] ?? collect()); @endphp
        @if($sekdes->count())
          @foreach($sekdes as $item)
            <div class="max-1">{!! pejabat($item) !!}</div>
          @endforeach
        @else
          <div class="max-1">{!! pejabat((object)['jabatan'=>'Sekretaris Desa','nama'=>'_____','foto'=>null]) !!}</div>
        @endif

        <div class="line big"></div>

        {{-- SECTION: KASI --}}
        <div class="section-wrap reveal">
          <div class="section-title">Kepala Seksi (KASI)</div>
        </div>

        <div class="max-5">
          <div class="hline"></div>
          <div class="grid-3">
            @forelse(($data['kasi'] ?? collect()) as $item)
              {!! pejabat($item) !!}
            @empty
              {!! pejabat((object)['jabatan'=>'Kasi Pemerintahan','nama'=>'_____','foto'=>null]) !!}
              {!! pejabat((object)['jabatan'=>'Kasi Kesejahteraan','nama'=>'_____','foto'=>null]) !!}
              {!! pejabat((object)['jabatan'=>'Kasi Pelayanan','nama'=>'_____','foto'=>null]) !!}
            @endforelse
          </div>
        </div>

        <div class="line big"></div>

        {{-- SECTION: KAUR --}}
        <div class="section-wrap reveal">
          <div class="section-title">Kepala Urusan (KAUR)</div>
        </div>

        <div class="max-5">
          <div class="grid-3">
            @forelse(($data['kaur'] ?? collect()) as $item)
              {!! pejabat($item) !!}
            @empty
              {!! pejabat((object)['jabatan'=>'Kaur TU & Umum','nama'=>'_____','foto'=>null]) !!}
              {!! pejabat((object)['jabatan'=>'Kaur Keuangan','nama'=>'_____','foto'=>null]) !!}
              {!! pejabat((object)['jabatan'=>'Kaur Perencanaan','nama'=>'_____','foto'=>null]) !!}
            @endforelse
          </div>
        </div>

        <div class="line big"></div>

        {{-- SECTION: KEPALA DUSUN --}}
        <div class="section-wrap reveal">
          <div class="section-title">Kepala Dusun</div>
        </div>

        <div class="max-5">
          <div class="grid-2">
            @forelse(($data['dusun'] ?? collect()) as $item)
              {!! pejabat($item) !!}
            @empty
              {!! pejabat((object)['jabatan'=>'Kepala Dusun I','nama'=>'_____','foto'=>null]) !!}
              {!! pejabat((object)['jabatan'=>'Kepala Dusun II','nama'=>'_____','foto'=>null]) !!}
            @endforelse
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<script>
(function(){
  const els = Array.from(document.querySelectorAll('.reveal'));
  if(!('IntersectionObserver' in window) || !els.length){
    els.forEach(el => el.classList.add('is-in'));
    return;
  }

  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(!entry.isIntersecting) return;
      entry.target.classList.add('is-in');
      io.unobserve(entry.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -10% 0px" });

  els.forEach((el, idx)=>{
    el.style.transitionDelay = (idx * 38) + "ms";
    io.observe(el);
  });
})();
</script>

@endsection
