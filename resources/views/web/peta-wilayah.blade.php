@extends('web.layouts.app')
@section('title','Peta Wilayah • Portal Desa Suriamedal')

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

  .pw-wrap{
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
    position:absolute; inset:-60px -40px auto auto;
    width:240px; height:240px;
    background: radial-gradient(circle at 30% 30%, rgba(34,197,94,.18), transparent 60%),
                radial-gradient(circle at 70% 70%, rgba(96,165,250,.18), transparent 60%),
                radial-gradient(circle at 50% 50%, rgba(168,85,247,.12), transparent 60%);
    filter: blur(2px);
    transform: rotate(18deg);
    pointer-events:none;
  }
  .hero-top{ display:flex; gap:14px; align-items:center; justify-content:space-between; flex-wrap:wrap; }
  .brand{ display:flex; gap:12px; align-items:center; }
  .mark{
    width:52px; height:52px; border-radius:18px;
    border:1px solid rgba(15,23,42,.12);
    background: linear-gradient(135deg, rgba(34,197,94,.20), rgba(96,165,250,.18), rgba(168,85,247,.14));
    box-shadow: 0 10px 24px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
    flex:0 0 auto;
  }
  .mark svg{ width:26px; height:26px; color: var(--ink); }
  .hero-title{
    margin:0;
    font-size:32px;
    line-height:1.08;
    letter-spacing:-0.03em;
    font-weight:950;
    color:var(--ink);
  }
  @media(max-width:768px){ .hero-title{ font-size:26px; } }
  .hero-sub{
    margin:6px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.7;
    max-width:860px;
  }

  /* LAYOUT */
  .layout{
    display:grid; gap:14px;
    margin-top:14px;
    grid-template-columns: 1fr;
  }
  @media(min-width: 1000px){
    .layout{ grid-template-columns: 360px 1fr; align-items:start; }
  }

  /* LEFT */
  .left-col{ display:flex; flex-direction:column; gap:12px; position:sticky; top:18px; align-self:start; }
  @media(max-width: 999px){ .left-col{ position:static; top:auto; } }

  .card{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .card-pad{ padding:16px; }

  .card h3{
    margin:0 0 10px;
    font-size:14px;
    font-weight:950;
    color:var(--ink);
    letter-spacing:-.01em;
  }

  .kv-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:12px;
  }
  .kv{
    border:1px solid rgba(15,23,42,.10);
    border-radius: 18px;
    background: rgba(248,250,252,.92);
    padding:12px;
  }
  .k{
    font-size:11px; font-weight:950; color:var(--muted);
    letter-spacing:.12em; text-transform:uppercase;
  }
  .v{
    margin-top:6px;
    font-size:16px;
    font-weight:950;
    color:var(--ink);
  }
  .note{
    margin-top:10px;
    color:var(--muted);
    font-size:13px;
    line-height:1.6;
  }

  /* TABLE BOUNDARY */
  .table-wrap{
    margin-top:10px;
    border:1px solid rgba(226,232,240,.95);
    border-radius:18px;
    overflow:hidden;
    background: rgba(255,255,255,.92);
  }
  table{ width:100%; border-collapse:separate; border-spacing:0; }
  thead th{
    text-align:left;
    font-size:11px;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:var(--muted);
    font-weight:950;
    padding:12px 14px;
    background: rgba(255,255,255,.98);
    border-bottom:1px solid rgba(226,232,240,.9);
  }
  tbody td{
    padding:12px 14px;
    border-bottom:1px solid rgba(226,232,240,.7);
    color:var(--ink);
    font-size:14px;
    background: rgba(255,255,255,.92);
    vertical-align:top;
  }
  tbody tr:last-child td{ border-bottom:none; }
  .num{ font-weight:950; }

  /* MAP */
  .map-card{ position:relative; }
  .map-wrap{
    position:relative;
    border-radius: var(--r24);
    overflow:hidden;
    min-height: 560px;
    background:#eef2ff;
  }
  @media(max-width: 999px){ .map-wrap{ min-height: 440px; } }

  /* iframe fill */
  .map-iframe{
    width:100%;
    height:560px;
    border:0;
    display:block;
  }
  @media(max-width: 999px){ .map-iframe{ height:440px; } }

  /* fallback image */
  .map-fallback{
    display:none;
    width:100%;
    height:560px;
    object-fit:cover;
    border-radius: var(--r24);
    background:#e2e8f0;
  }
  @media(max-width: 999px){ .map-fallback{ height:440px; } }

  /* TOP MAP BAR */
  .map-bar{
    position:absolute;
    top:12px; left:12px; right:12px;
    z-index: 50;
    display:flex;
    gap:10px;
    align-items:center;
    flex-wrap:wrap;
    pointer-events:none;
  }
  .map-bar > *{ pointer-events:auto; }

  .search{
    flex: 1 1 520px;
    min-width: 260px;
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px 12px;
    border-radius: 18px;
    background: rgba(255,255,255,.92);
    border: 1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    backdrop-filter: blur(10px);
  }
  .search input{
    border:none; outline:none; background:transparent;
    width:100%;
    font-weight:950;
    color: var(--ink);
    font-size:14px;
  }
  .hint{
    color: var(--muted);
    font-weight:900;
    font-size:13px;
    white-space:nowrap;
    user-select:none;
    padding:6px 10px;
    border-radius: 12px;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.92);
    cursor:pointer;
  }

  .btn{
    appearance:none; border:none; cursor:pointer;
    padding:10px 12px;
    border-radius:16px;
    font-weight:950;
    font-size:13px;
    color:var(--ink);
    background: rgba(255,255,255,.92);
    border:1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    text-decoration:none;
    display:inline-flex; gap:10px; align-items:center;
    backdrop-filter: blur(10px);
  }
  .btn:hover{ transform: translateY(-1px); transition:.16s ease; }
  .btn svg{ width:18px; height:18px; }

  .btn.primary{
    background: linear-gradient(135deg, rgba(34,197,94,.18), rgba(96,165,250,.16));
    border-color: rgba(34,197,94,.22);
  }

  .layer-pill{
    width:44px; height:44px;
    border-radius:16px;
    background: rgba(255,255,255,.92);
    border:1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    display:flex; align-items:center; justify-content:center;
    cursor:pointer;
    user-select:none;
  }
  .layer-pill svg{ width:20px; height:20px; color:#334155; }

  .toast{
    position:absolute;
    left:12px; bottom:12px;
    z-index: 50;
    background: rgba(255,255,255,.92);
    border:1px solid rgba(15,23,42,.12);
    border-radius: 16px;
    box-shadow: var(--shadow2);
    padding:10px 12px;
    color:#334155;
    font-size:13px;
    display:none;
    max-width: 520px;
  }

  @media print{
    .pw-wrap{ padding:0; background:#fff; }
    .map-bar, .toast{ display:none !important; }
    .card{ box-shadow:none; backdrop-filter:none; background:#fff; }
  }
</style>

@php
  // ✅ Ringkasan (bisa kamu update kapan saja)
  $luas_ha = 12.50;
  $luas_m2 = (int) round($luas_ha * 10000);

  $wilayah = [
    'desa' => 'Desa Suriamedal',
    'kecamatan' => 'Kecamatan Surian',
    'kabupaten' => 'Kabupaten Sumedang',
    'luas_ha' => $luas_ha,
    'luas_m2' => $luas_m2,
    'penduduk' => 1138,
  ];

  $batas = [
    ['arah'=>'Utara',   'wilayah'=>'Desa Tanjung (Kec. Gantar, Kab. Indramayu)'],
    ['arah'=>'Selatan', 'wilayah'=>'Desa Surian (Kab. Sumedang)'],
    ['arah'=>'Timur',   'wilayah'=>'Desa Surian (Kab. Sumedang)'],
    ['arah'=>'Barat',   'wilayah'=>'Cibaldongjaya (Kab. Subang)'],
  ];

  $fmtNum = fn($n) => is_null($n) ? '—' : number_format($n,0,',','.');
  $fmtDec = fn($n) => is_null($n) ? '—' : number_format($n,2,',','.');
@endphp

<div class="pw-wrap">
  <div class="container-max">

    <div class="hero">
      <div class="hero-top">
        <div class="brand">
          <div class="mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 2c4 4 8 6 8 11a8 8 0 1 1-16 0c0-5 4-7 8-11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              <path d="M12 7v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M8 11h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <h1 class="hero-title">Peta Wilayah Desa</h1>
            <p class="hero-sub">
              Menampilkan peta lokasi (<b>Google Maps</b>) untuk <b>{{ $wilayah['desa'] }}</b>.
              Jika perangkat sedang offline / DNS bermasalah, sistem otomatis menampilkan <b>peta gambar</b> (fallback).
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="layout">

      {{-- LEFT --}}
      <div class="left-col">

        <div class="card">
          <div class="card-pad">
            <h3>Wilayah Administrasi</h3>
            <div class="kv-grid">
              <div class="kv">
                <div class="k">Desa</div>
                <div class="v">{{ $wilayah['desa'] }}</div>
              </div>
              <div class="kv">
                <div class="k">Kecamatan</div>
                <div class="v">{{ $wilayah['kecamatan'] }}</div>
              </div>
              <div class="kv" style="grid-column: 1 / -1;">
                <div class="k">Kabupaten</div>
                <div class="v">{{ $wilayah['kabupaten'] }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-pad">
            <h3>Batas Desa</h3>
            <div class="table-wrap">
              <table>
                <thead>
                  <tr>
                    <th style="width:140px;">Arah</th>
                    <th>Berbatasan dengan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($batas as $b)
                    <tr>
                      <td class="num">{{ $b['arah'] }}</td>
                      <td>{{ $b['wilayah'] ?: '—' }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="note">
              Data batas desa & luas dapat kamu sesuaikan dari dokumen resmi desa.
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-pad">
            <h3>Ringkasan</h3>
            <div class="kv-grid">
              <div class="kv">
                <div class="k">Luas Desa</div>
                <div class="v">
                  {{ $fmtNum($wilayah['luas_m2']) }}
                  <span style="font-weight:900; color:#64748b;">m²</span>
                </div>
                <div style="margin-top:6px; color:#64748b; font-weight:900; font-size:13px;">
                  ({{ $fmtDec($wilayah['luas_ha']) }} Ha)
                </div>
              </div>
              <div class="kv">
                <div class="k">Jumlah Penduduk</div>
                <div class="v">
                  {{ $fmtNum($wilayah['penduduk']) }}
                  <span style="font-weight:900; color:#64748b;">Jiwa</span>
                </div>
              </div>
            </div>

            <div class="note">
              Jika ada angka resmi terbaru, update nilainya di variabel <b>$wilayah</b>.
            </div>
          </div>
        </div>

      </div>

      {{-- RIGHT / MAP --}}
      <div class="card map-card">
        <div class="map-wrap">

          {{-- TOP BAR --}}
          <div class="map-bar">
            <div class="search">
              <input id="q" type="text"
                     value="Desa Suriamedal, Surian, Sumedang"
                     placeholder="Telusuri peta (contoh: Desa Suriamedal)"/>
              <span class="hint" id="btnSearch">Cari</span>
            </div>

            <button class="btn primary" type="button" id="btnCenter">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M12 18v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M3 12h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M18 12h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
              </svg>
              Pusat Desa
            </button>

            <div class="layer-pill" id="btnLayers" title="Ganti Streets / Satellite">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 2l9 5-9 5-9-5 9-5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M3 12l9 5 9-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 17l9 5 9-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>

          {{-- GOOGLE MAPS EMBED + FALLBACK IMAGE --}}
          <iframe
            id="gmap"
            class="map-iframe"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
            src=""
            onerror="document.getElementById('mapFallback').style.display='block'; this.style.display='none';"
          ></iframe>

          {{-- ✅ Fallback image (WAJIB ADA FILE) --}}
          {{-- Simpan gambar di: public/images/peta/peta-wilayah.jpg --}}
          <img
            id="mapFallback"
            class="map-fallback"
            src="/images/peta/peta-wilayah.jpg"
            alt="Peta Wilayah Desa Suriamedal (Offline)"
          >

          <div class="toast" id="toast"></div>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
(function(){
  const toastEl = document.getElementById('toast');
  const iframe  = document.getElementById('gmap');
  const fb      = document.getElementById('mapFallback');

  const showToast = (msg) => {
    toastEl.textContent = msg;
    toastEl.style.display = 'block';
    clearTimeout(showToast._t);
    showToast._t = setTimeout(()=> toastEl.style.display = 'none', 2600);
  };

  // =========================
  // MODE:
  // - "m" = streets
  // - "k" = satellite
  // =========================
  let mode = 'k'; // default satellite biar bendungan kelihatan

  const DEFAULT_QUERY = "Desa Suriamedal, Surian, Sumedang";
  const DEFAULT_ZOOM  = 14;

  function buildSrc(query){
    const q = encodeURIComponent(query);
    return `https://www.google.com/maps?q=${q}&z=${DEFAULT_ZOOM}&t=${mode}&hl=id&output=embed`;
  }

  function showFallback(msg){
    if (fb) fb.style.display = 'block';
    if (iframe) iframe.style.display = 'none';
    showToast(msg || 'Peta ditampilkan dalam mode gambar (offline).');
  }

  function setMap(query){
    try{
      iframe.style.display = 'block';
      fb.style.display = 'none';
      iframe.src = buildSrc(query);
    }catch(e){
      showFallback('Peta gagal dimuat. Menampilkan mode gambar.');
    }
  }

  // Init
  setMap(DEFAULT_QUERY);
  showToast('Mode: Satellite (default). Klik ikon layer untuk Streets.');

  // Fallback jika dalam 3 detik belum tampil (kasus DNS/offline)
  setTimeout(() => {
    // kalau src ada tapi iframe gagal tampil/blocked, fallback aman
    if (!iframe || !iframe.src) return;
    // heuristic sederhana: jika iframe disembunyikan oleh browser error, pakai fallback
    // (tetap aman kalau internet lambat — user bisa refresh)
    // Di banyak kasus DNS error, iframe tetap kosong.
    const rect = iframe.getBoundingClientRect();
    if (rect.height === 0 || iframe.style.display === 'none') {
      showFallback();
    }
  }, 3000);

  // Search
  const input = document.getElementById('q');
  const btnSearch = document.getElementById('btnSearch');

  function doSearch(){
    const q = (input.value || '').trim();
    if(!q){ showToast('Isi kata kunci dulu.'); return; }
    setMap(q);
    showToast('Menampilkan lokasi...');
  }

  btnSearch.addEventListener('click', doSearch);
  input.addEventListener('keydown', (e) => {
    if(e.key === 'Enter'){ e.preventDefault(); doSearch(); }
  });

  // Pusat desa
  document.getElementById('btnCenter').addEventListener('click', () => {
    input.value = DEFAULT_QUERY;
    setMap(DEFAULT_QUERY);
    showToast('Kembali ke pusat desa.');
  });

  // Toggle layer
  document.getElementById('btnLayers').addEventListener('click', () => {
    mode = (mode === 'k') ? 'm' : 'k';
    setMap((input.value || DEFAULT_QUERY).trim() || DEFAULT_QUERY);
    showToast(mode === 'k' ? 'Mode: Satellite' : 'Mode: Streets');
  });
})();
</script>

@endsection
