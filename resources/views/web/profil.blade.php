@extends('web.layouts.app')
@section('title','Profil Desa (PRODESKEL) • Portal Desa Suriamedal')

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
    --shadow: 0 18px 45px rgba(2,6,23,.10);
    --shadow2: 0 10px 28px rgba(2,6,23,.08);

    --accent:#0f766e;
  }

  .pr-wrap{
    width:100%;
    padding:44px 0 78px;
    background:
      radial-gradient(950px 520px at 12% 0%, var(--g1), transparent 60%),
      radial-gradient(900px 520px at 88% 10%, var(--g2), transparent 55%),
      radial-gradient(900px 560px at 50% 110%, var(--g3), transparent 55%),
      linear-gradient(180deg, #f6f9ff, #f7fff8);
  }
  .container-max{ max-width:1200px; margin:0 auto; padding:0 16px; }

  .hero{
    position:relative;
    background: var(--card);
    border:1px solid var(--line);
    border-radius: 28px;
    box-shadow: var(--shadow);
    padding:18px;
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .hero::before{
    content:"";
    position:absolute; inset:-70px -50px auto auto;
    width:280px; height:280px;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.18), transparent 60%),
      radial-gradient(circle at 70% 70%, rgba(96,165,250,.18), transparent 60%),
      radial-gradient(circle at 50% 50%, rgba(168,85,247,.12), transparent 60%);
    filter: blur(1px);
    transform: rotate(18deg);
    pointer-events:none;
  }

  .hero-top{ display:flex; gap:14px; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; }
  .brand{ display:flex; gap:12px; align-items:flex-start; }
  .mark{
    width:54px; height:54px; border-radius:18px;
    border:1px solid rgba(15,23,42,.12);
    background: linear-gradient(135deg, rgba(34,197,94,.20), rgba(96,165,250,.18), rgba(168,85,247,.14));
    box-shadow: 0 12px 26px rgba(2,6,23,.12);
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
    margin:8px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.7;
    max-width:860px;
  }

  .hero-badges{ margin-top:12px; display:flex; gap:10px; flex-wrap:wrap; }
  .badge{
    display:inline-flex; align-items:center; gap:8px;
    padding:8px 12px;
    border-radius:999px;
    border:1px solid rgba(15,23,42,.10);
    background: rgba(248,250,252,.92);
    font-weight:950;
    font-size:12px;
    color:#334155;
    white-space:nowrap;
  }
  .badge.green{
    border-color: rgba(15,118,110,.22);
    background: rgba(15,118,110,.10);
    color:#0f766e;
  }

  .hero-actions{ display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-top:14px; }

  .btn{
    appearance:none; border:none; cursor:pointer;
    padding:10px 12px;
    border-radius:14px;
    font-weight:950;
    font-size:13px;
    color:var(--ink);
    background: rgba(255,255,255,.90);
    border:1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    text-decoration:none;
    display:inline-flex; gap:10px; align-items:center;
    transition: transform .16s ease, filter .16s ease, box-shadow .16s ease;
  }
  .btn:hover{ transform: translateY(-1px); }
  .btn.primary{
    background: linear-gradient(135deg, rgba(34,197,94,.18), rgba(96,165,250,.16));
    border-color: rgba(34,197,94,.22);
  }
  .btn.dark{
    background: rgba(15,23,42,.92);
    color:#fff;
    border-color: rgba(15,23,42,.12);
  }
  .btn.dark:hover{ filter: brightness(1.06); }
  .btn svg{ width:18px; height:18px; }

  .layout{ display:grid; gap:14px; margin-top:14px; grid-template-columns: 1fr; }
  @media(min-width: 1000px){ .layout{ grid-template-columns: 320px 1fr; align-items:start; } }

  .side{
    position:sticky; top:18px;
    background: var(--card);
    border:1px solid var(--line);
    border-radius: 28px;
    box-shadow: var(--shadow);
    padding:14px;
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .side-head{
    padding:12px 12px 10px;
    border:1px solid rgba(15,23,42,.08);
    border-radius:18px;
    background:
      radial-gradient(520px 140px at 10% 0%, rgba(96,165,250,.12), transparent 60%),
      radial-gradient(520px 140px at 90% 0%, rgba(34,197,94,.10), transparent 60%),
      rgba(255,255,255,.85);
  }
  .side h3{ margin:0; font-size:14px; font-weight:950; color:var(--ink); }
  .side p{ margin:6px 0 0; color:var(--muted); font-size:13px; line-height:1.6; }

  .nav{ margin-top:10px; display:flex; flex-direction:column; gap:8px; }
  .nav a{
    text-decoration:none;
    padding:10px 12px;
    border-radius: 14px;
    border:1px solid rgba(15,23,42,.10);
    background: rgba(248,250,252,.92);
    color:#334155;
    font-weight:950;
    font-size:13px;
    display:flex; justify-content:space-between; align-items:center;
    transition: transform .16s ease, background .16s ease, border-color .16s ease, box-shadow .16s ease;
  }
  .nav a:hover{
    background: rgba(226,232,240,.9);
    transform: translateY(-1px);
    box-shadow: 0 10px 18px rgba(2,6,23,.06);
  }
  .nav a.is-active{
    border-color: rgba(15,118,110,.28);
    background: rgba(15,118,110,.08);
    box-shadow: 0 10px 20px rgba(2,6,23,.07);
  }
  .nav small{ color:var(--muted); font-weight:900; }

  .card{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: 28px;
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .card-pad{ padding:16px; }
  .section{ scroll-margin-top: 92px; }

  .sec-head{ display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap; }
  .sec-title{ margin:0; font-weight:950; color:var(--ink); font-size:16px; }
  .sec-sub{ margin:6px 0 0; color:var(--muted); font-size:13px; line-height:1.65; }
  .chip{
    display:inline-flex; align-items:center;
    padding:7px 10px;
    border-radius:999px;
    border:1px solid rgba(15,23,42,.10);
    background: rgba(248,250,252,.92);
    font-weight:950;
    font-size:12px;
    color:#334155;
    white-space:nowrap;
  }

  .grid-3{ display:grid; grid-template-columns:1fr; gap:12px; margin-top:12px; }
  @media(min-width:900px){ .grid-3{ grid-template-columns: repeat(3, 1fr); } }
  .mini{
    border:1px solid rgba(15,23,42,.10);
    border-radius: 18px;
    background: rgba(248,250,252,.92);
    padding:12px;
  }
  .mini .k{
    font-size:11px; font-weight:950; color:var(--muted);
    letter-spacing:.12em; text-transform:uppercase;
  }
  .mini .v{ margin-top:6px; font-size:18px; font-weight:950; color:var(--ink); }
  .mini .s{ margin-top:4px; font-size:12px; color:var(--muted); }

  .table-wrap{
    margin-top:12px;
    border:1px solid rgba(226,232,240,.95);
    border-radius:18px;
    overflow:auto;
    background: rgba(255,255,255,.92);
  }
  table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
    min-width: 640px;
  }
  thead th{
    position:sticky; top:0; z-index:1;
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
  tbody tr:hover td{ background: rgba(248,250,252,.98); }
  .num{ font-weight:950; }
  .muted{ color:var(--muted); }

  .chart{
    margin-top:12px;
    border:1px solid rgba(226,232,240,.95);
    border-radius: 18px;
    background: rgba(255,255,255,.92);
    padding:14px;
    box-shadow: 0 10px 26px rgba(2,6,23,.05);
  }
  .chart-title{ display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; margin-bottom:10px; }
  .chart-title h4{ margin:0; font-size:14px; font-weight:950; color:var(--ink); }

  /* ===== DOCS ===== */
  .doc-grid{ display:grid; gap:12px; margin-top:12px; }
  @media(min-width: 900px){ .doc-grid{ grid-template-columns: 1fr 1fr; } }

  .doc-card{
    border:1px solid rgba(15,23,42,.10);
    border-radius:18px;
    background: rgba(255,255,255,.94);
    overflow:hidden;
  }
  .doc-head{
    padding:12px 14px;
    display:flex;
    gap:10px;
    align-items:flex-start;
    justify-content:space-between;
    border-bottom:1px solid rgba(226,232,240,.85);
    background: linear-gradient(180deg, rgba(248,250,252,.98), rgba(255,255,255,.92));
  }
  .doc-badge{
    display:inline-flex;
    padding:6px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:950;
    border:1px solid rgba(15,23,42,.12);
    color:#0f172a;
    background: rgba(34,197,94,.10);
    white-space:nowrap;
  }
  .doc-badge.warn{
    background: rgba(251,191,36,.16);
    border-color: rgba(251,191,36,.30);
  }
  .doc-title{ margin:0; font-size:13px; font-weight:950; color:var(--ink); line-height:1.3; }
  .doc-meta{ margin:6px 0 0; font-size:12px; color:var(--muted); line-height:1.5; }
  .doc-body{ padding:12px 14px 14px; }
  .doc-desc{ margin:0 0 12px; color:var(--muted); font-size:13px; line-height:1.65; }

  .doc-actions{ display:flex; gap:10px; flex-wrap:wrap; align-items:center; }
  .doc-btn{
    appearance:none; border:none; cursor:pointer;
    padding:9px 11px;
    border-radius:14px;
    font-weight:950;
    font-size:12px;
    color:var(--ink);
    background: rgba(255,255,255,.92);
    border:1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    text-decoration:none;
    display:inline-flex;
    gap:8px;
    align-items:center;
    transition: transform .16s ease, box-shadow .16s ease, filter .16s ease;
  }
  .doc-btn:hover{ transform: translateY(-1px); box-shadow: 0 12px 22px rgba(2,6,23,.08); }
  .doc-btn[aria-disabled="true"]{
    opacity:.55;
    pointer-events:none;
    filter: grayscale(0.2);
  }

  /* ===== VIEWER (seperti sebelumnya) ===== */
  .viewer{
    margin-top:12px;
    border-radius:16px;
    overflow:hidden;
    border:1px solid rgba(226,232,240,.9);
    background:#fff;
  }
  .viewer .viewer-bar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    padding:10px 12px;
    background: rgba(248,250,252,.98);
    border-bottom:1px solid rgba(226,232,240,.9);
  }
  .viewer .viewer-bar b{ font-size:12px; color:#0f172a; }
  .viewer .viewer-bar span{ font-size:12px; color:var(--muted); }
  .viewer iframe{ width:100%; height:420px; border:0; display:block; background:#fff; }
  @media(max-width: 999px){ .viewer iframe{ height:360px; } }

  .file-missing{
    margin-top:12px;
    padding:12px 14px;
    border-radius:16px;
    border:1px dashed rgba(251,191,36,.55);
    background: rgba(251,191,36,.12);
    color:#92400e;
    font-weight:900;
    font-size:13px;
    line-height:1.5;
  }

  @media print{
    .btn, .side, .doc-actions, .viewer .viewer-bar button{ display:none !important; }
    .pr-wrap{ padding:0; background:#fff; }
    .card{ box-shadow:none; backdrop-filter:none; background:#fff; }
    .hero{ box-shadow:none; }
    .viewer iframe{ height:520px; }
  }
</style>

@php
  $prodeskel = [
    'meta' => [
      'judul' => 'PROFIL DESA (PRODESKEL)',
      'desa'  => 'Desa Suriamedal',
      'kecamatan' => 'Kecamatan Surian',
      'kabupaten' => 'Kabupaten Sumedang',
      'tahun' => '2024',
    ],
    'batas' => [
      ['arah'=>'Utara', 'wilayah'=>'Desa Sukarapih'],
      ['arah'=>'Selatan', 'wilayah'=>'Desa Pamulihan'],
      ['arah'=>'Timur', 'wilayah'=>'Desa Pamulihan'],
      ['arah'=>'Barat', 'wilayah'=>'Desa Cimalaka'],
    ],
    'kependudukan' => [
      'bulan_tahun' => 'Mei 2024',
      'tahun_ini' => ['male'=>557, 'female'=>581, 'total'=>1138],
      'tahun_lalu' => ['male'=>555, 'female'=>579, 'total'=>1134],
      'kk' => [
        'tahun_ini' => ['male'=>0, 'female'=>0, 'total'=>416],
        'tahun_lalu' => ['male'=>0, 'female'=>0, 'total'=>414],
      ],
    ],
    'anggaran' => [
      'total' => 1427221000,
      'sumber' => [
        ['nama'=>'APBD Kabupaten/Kota', 'nilai'=>0],
        ['nama'=>'Bantuan Pemerintah Kabupaten/Kota', 'nilai'=>66508000],
        ['nama'=>'Bantuan Pemerintah Provinsi', 'nilai'=>130000000],
        ['nama'=>'Bantuan Pemerintah Pusat', 'nilai'=>766675000],
        ['nama'=>'Pendapatan Asli Desa', 'nilai'=>0],
        ['nama'=>'Swadaya Masyarakat Desa/Kelurahan', 'nilai'=>0],
        ['nama'=>'Alokasi Dana Desa', 'nilai'=>464038000],
        ['nama'=>'Pendapatan dari Perusahaan di Desa', 'nilai'=>0],
        ['nama'=>'Pendapatan lain yang sah & tidak mengikat', 'nilai'=>0],
      ],
      'belanja' => [
        ['nama'=>'Belanja Publik / Pembangunan', 'nilai'=>1000748200],
        ['nama'=>'Belanja Aparatur / Pegawai', 'nilai'=>426472800],
      ]
    ],
  ];

  // URL aman untuk file yang ada spasi
  $fileUrl = fn(string $file) => asset('files/'.rawurlencode($file));
  $fileOk  = fn(string $file) => file_exists(public_path('files/'.$file));

  // ✅ DISAMAKAN dengan nama file yang kamu punya di public/files (lihat screenshot kamu)
  $docs = [
    'rpjmdes' => [
      'title' => 'Perdes RPJMDesa 2021–2026',
      'meta'  => 'Dokumen Perencanaan 6 Tahun',
      'desc'  => 'RPJMDesa sebagai acuan penyusunan RKPDesa dan prioritas pembangunan desa.',
      'file'  => 'Perdes RPJMDesa 2021-2026.pdf',
      'badge' => 'RPJMDesa',
    ],
    'rkpdes_2023' => [
      'title' => 'Perdes RKPDesa Tahun 2023',
      'meta'  => 'Dokumen Perencanaan Tahunan',
      'desc'  => 'Dokumen RKPDesa sebagai pedoman pelaksanaan pembangunan Desa Tahun 2023.',
      'file'  => 'perdes_rkpdes_2023.pdf',
      'badge' => 'RKPDesa',
    ],
    'rkpdes_2024' => [
      'title' => 'Perdes RKPDesa Tahun 2024',
      'meta'  => 'Dokumen Perencanaan Tahunan',
      'desc'  => 'Dokumen RKPDesa sebagai pedoman pelaksanaan pembangunan Desa Tahun 2024.',
      'file'  => 'perdes_rkpdes_2024.pdf',
      'badge' => 'RKPDesa',
    ],
    'bumdes_pendirian_2018' => [
      'title' => 'Perdes Pendirian BUMDesa',
      'meta'  => 'Perdes Tahun 2018',
      'desc'  => 'Payung hukum pendirian BUMDesa beserta pengelolaan, jenis usaha, dan pertanggungjawaban.',
      'file'  => 'perdes_pendirian_bumdes_2018.pdf',
      'badge' => 'BUMDesa',
    ],
    'bumdes_modal_2024' => [
      'title' => 'Perdes Penyertaan Modal Desa pada BUMDesa (TA 2024)',
      'meta'  => 'Perdes Tahun 2024',
      'desc'  => 'Mengatur penyertaan modal desa pada BUMDesa tahun anggaran 2024.',
      'file'  => 'perdes_penyertaan_modal_bumdes_2024.pdf',
      'badge' => 'BUMDesa',
    ],
  ];

  $fmt = fn($n) => 'Rp '.number_format($n,0,',','.');
  $kp = $prodeskel['kependudukan'];
  $growthPop = $kp['tahun_ini']['total'] - $kp['tahun_lalu']['total'];
@endphp

<div class="pr-wrap">
  <div class="container-max">

    {{-- HERO --}}
    <div class="hero">
      <div class="hero-top">
        <div class="brand">
          <div class="mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 2l7 4v6c0 5-3 9-7 10C8 21 5 17 5 12V6l7-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              <path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h1 class="hero-title">Profil Desa (PRODESKEL)</h1>
            <p class="hero-sub">
              Ringkasan profil resmi berbasis PRODESKEL untuk <b>{{ $prodeskel['meta']['desa'] }}</b>.
              Disusun agar mudah dipahami warga & perangkat desa, serta siap diperluas (RPJMDes, RKPDes, Perdes BUMDesa).
            </p>

            <div class="hero-badges">
              <span class="badge green">Tahun Data: {{ $prodeskel['meta']['tahun'] }}</span>
              <span class="badge">Kabupaten: {{ $prodeskel['meta']['kabupaten'] }}</span>
              <span class="badge">Kecamatan: {{ $prodeskel['meta']['kecamatan'] }}</span>
            </div>
          </div>
        </div>

        <div class="hero-actions">
          @php $proFile = 'prodeskel.pdf'; @endphp
          <a class="btn primary" href="{{ $fileUrl($proFile) }}" target="_blank" rel="noopener" aria-disabled="{{ $fileOk($proFile) ? 'false':'true' }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 3v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M8 11l4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Unduh PDF PRODESKEL
          </a>

          <button class="btn dark" type="button" onclick="window.print()">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M6 9V4h12v5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M6 14h12v6H6z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Cetak / Save PDF
          </button>
        </div>
      </div>

      @if(!$fileOk($proFile))
        <div class="file-missing" style="margin-top:12px;">
          PDF PRODESKEL tidak ditemukan: <b>{{ $proFile }}</b> di <b>public/files/</b>.
        </div>
      @endif
    </div>

    <div class="layout">

      {{-- SIDEBAR --}}
      <aside class="side">
        <div class="side-head">
          <h3>Daftar Isi Profil</h3>
          <p>Klik untuk lompat ke bagian. Menu aktif otomatis saat kamu scroll.</p>
        </div>

        <nav class="nav" id="prNav">
          <a href="#pembuka" data-target="pembuka">Pembuka <small>Ringkasan</small></a>
          <a href="#sda" data-target="sda">Sumber Daya Alam <small>Batas Wilayah</small></a>
          <a href="#kependudukan" data-target="kependudukan">Kependudukan <small>Perkembangan</small></a>
          <a href="#anggaran" data-target="anggaran">Anggaran Desa <small>Transparansi</small></a>
          <a href="#rpjm" data-target="rpjm">RPJMDes <small>Perencanaan</small></a>
          <a href="#rkpdes" data-target="rkpdes">Perdes RKPDes <small>Dokumen</small></a>
          <a href="#perdes" data-target="perdes">Perdes Desa <small>BUMDesa</small></a>
        </nav>
      </aside>

      {{-- MAIN --}}
      <main style="display:flex; flex-direction:column; gap:14px;">

        {{-- PEMBUKA --}}
        <section id="pembuka" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Pembuka PRODESKEL</h2>
                <p class="sec-sub">Ringkasan utama profil desa yang siap dipresentasikan.</p>
              </div>
              <span class="chip">Ringkasan</span>
            </div>

            <div class="grid-3">
              <div class="mini">
                <div class="k">Desa</div>
                <div class="v">{{ $prodeskel['meta']['desa'] }}</div>
                <div class="s">Profil desa (ringkasan PRODESKEL)</div>
              </div>
              <div class="mini">
                <div class="k">Kecamatan</div>
                <div class="v">{{ $prodeskel['meta']['kecamatan'] }}</div>
                <div class="s">Wilayah administrasi</div>
              </div>
              <div class="mini">
                <div class="k">Kabupaten</div>
                <div class="v">{{ $prodeskel['meta']['kabupaten'] }}</div>
                <div class="s">Pemerintahan daerah</div>
              </div>
            </div>
          </div>
        </section>

        {{-- SDA --}}
        <section id="sda" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Sumber Daya Alam</h2>
                <p class="sec-sub">Informasi batas wilayah administrasi.</p>
              </div>
              <span class="chip">Batas Wilayah</span>
            </div>

            <div class="table-wrap">
              <table>
                <thead><tr><th style="width:140px;">Arah</th><th>Berbatasan dengan</th></tr></thead>
                <tbody>
                  @foreach($prodeskel['batas'] as $b)
                    <tr><td class="num">{{ $b['arah'] }}</td><td>{{ $b['wilayah'] }}</td></tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>

        {{-- KEPENDUDUKAN --}}
        <section id="kependudukan" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Kependudukan</h2>
                <p class="sec-sub">Perbandingan penduduk (tahun ini vs tahun lalu).</p>
              </div>
              <span class="chip">Periode: {{ $kp['bulan_tahun'] }}</span>
            </div>

            <div class="grid-3">
              <div class="mini">
                <div class="k">Penduduk (Tahun Ini)</div>
                <div class="v">{{ number_format($kp['tahun_ini']['total'],0,',','.') }}</div>
                <div class="s">L: {{ number_format($kp['tahun_ini']['male'],0,',','.') }} • P: {{ number_format($kp['tahun_ini']['female'],0,',','.') }}</div>
              </div>
              <div class="mini">
                <div class="k">Penduduk (Tahun Lalu)</div>
                <div class="v">{{ number_format($kp['tahun_lalu']['total'],0,',','.') }}</div>
                <div class="s">L: {{ number_format($kp['tahun_lalu']['male'],0,',','.') }} • P: {{ number_format($kp['tahun_lalu']['female'],0,',','.') }}</div>
              </div>
              <div class="mini">
                <div class="k">Perubahan</div>
                <div class="v">{{ $growthPop >= 0 ? '+' : '' }}{{ number_format($growthPop,0,',','.') }}</div>
                <div class="s">Selisih tahun ini vs tahun lalu</div>
              </div>
            </div>

            <div class="chart">
              <div class="chart-title">
                <h4>Grafik Perbandingan Jumlah Penduduk</h4>
                <span class="chip">Tahun Ini vs Tahun Lalu</span>
              </div>
              <canvas id="popCompareChart" height="210"></canvas>
              <div class="muted" style="margin-top:8px;">Grafik tegas dan nyaman dibaca.</div>
            </div>
          </div>
        </section>

        {{-- ANGGARAN --}}
        <section id="anggaran" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Anggaran Desa (Transparansi)</h2>
                <p class="sec-sub">Ringkasan total anggaran, komposisi belanja, serta sumber pendapatan.</p>
                <div style="margin-top:10px; display:flex; gap:10px; flex-wrap:wrap;">
                  <a class="btn dark" href="{{ route('anggaran') }}">Buka Halaman Anggaran</a>
                  <a class="btn" href="#anggaran">Tautan Bagian</a>
                </div>
              </div>
              <span class="chip">{{ $fmt($prodeskel['anggaran']['total']) }}</span>
            </div>

            <div class="grid-3">
              <div class="mini"><div class="k">Total Anggaran</div><div class="v">{{ $fmt($prodeskel['anggaran']['total']) }}</div><div class="s">Ringkasan anggaran (publik)</div></div>
              <div class="mini"><div class="k">Belanja Pembangunan</div><div class="v">{{ $fmt($prodeskel['anggaran']['belanja'][0]['nilai']) }}</div><div class="s">Publik / pembangunan</div></div>
              <div class="mini"><div class="k">Belanja Aparatur</div><div class="v">{{ $fmt($prodeskel['anggaran']['belanja'][1]['nilai']) }}</div><div class="s">Aparatur / pegawai</div></div>
            </div>

            <div class="chart">
              <div class="chart-title"><h4>Grafik Komposisi Belanja</h4><span class="chip">Pembangunan vs Aparatur</span></div>
              <canvas id="budgetPieChart" height="210"></canvas>
            </div>

            <div class="table-wrap">
              <table>
                <thead><tr><th>Sumber Anggaran</th><th style="width:260px;">Nilai</th></tr></thead>
                <tbody>
                @foreach($prodeskel['anggaran']['sumber'] as $s)
                  <tr><td class="num">{{ $s['nama'] }}</td><td>{{ $fmt($s['nilai']) }}</td></tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>

        {{-- ====== TEMPLATE KARTU DOKUMEN (dengan preview seperti sebelumnya) ====== --}}
        @php
          $renderDoc = function($docKey, $id) use ($docs, $fileOk, $fileUrl){
            $d  = $docs[$docKey];
            $f  = $d['file'];
            $ok = $fileOk($f);
            $u  = $fileUrl($f);
        @endphp

          <div class="doc-card" id="{{ $id }}">
            <div class="doc-head">
              <div>
                <p class="doc-title">{{ $d['title'] }}</p>
                <p class="doc-meta">{{ $d['meta'] }}</p>
              </div>
              <span class="doc-badge {{ $ok ? '' : 'warn' }}">{{ $ok ? $d['badge'] : 'File belum ada' }}</span>
            </div>

            <div class="doc-body">
              <p class="doc-desc">{{ $d['desc'] }}</p>

              <div class="doc-actions">
                <a class="doc-btn" href="{{ $u }}" target="_blank" rel="noopener" aria-disabled="{{ $ok ? 'false':'true' }}">Buka PDF</a>
                <a class="doc-btn" href="{{ $u }}" download aria-disabled="{{ $ok ? 'false':'true' }}">Unduh</a>
                <button class="doc-btn" type="button" onclick="printPdf('{{ $u }}')" aria-disabled="{{ $ok ? 'false':'true' }}">Cetak</button>

                @if($ok)
                  <button class="doc-btn" type="button" onclick="toggleViewer('{{ $id }}')">Sembunyikan / Tampilkan Pratinjau</button>
                @endif
              </div>

              @if($ok)
                <div class="viewer" data-viewer="{{ $id }}">
                  <div class="viewer-bar">
                    <b>Pratinjau PDF</b>
                    <span>Scroll untuk membaca</span>
                  </div>
                  <iframe src="{{ $u }}#toolbar=1&navpanes=0&scrollbar=1"></iframe>
                </div>
              @else
                <div class="file-missing">
                  File tidak ditemukan di <b>public/files/</b> dengan nama: <b>{{ $f }}</b><br>
                  Pastikan nama file di kode sama persis dengan nama file di folder.
                </div>
              @endif
            </div>
          </div>

        @php }; @endphp
        {{-- ====== END TEMPLATE ====== --}}

        {{-- RPJMDes --}}
        <section id="rpjm" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">RPJMDes</h2>
                <p class="sec-sub">Dokumen perencanaan 6 tahun dan acuan penyusunan RKPDesa.</p>
              </div>
              <span class="chip">Periode 2021–2026</span>
            </div>

            <div style="margin-top:12px;">
              @php $renderDoc('rpjmdes', 'doc-rpjm'); @endphp
            </div>
          </div>
        </section>

        {{-- RKPDes --}}
        <section id="rkpdes" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Perdes RKPDesa</h2>
                <p class="sec-sub">Dokumen resmi perencanaan tahunan (RKPDesa).</p>
              </div>
              <span class="chip">Dokumen Perencanaan</span>
            </div>

            <div class="doc-grid">
              @php $renderDoc('rkpdes_2023', 'doc-rkp-2023'); @endphp
              @php $renderDoc('rkpdes_2024', 'doc-rkp-2024'); @endphp
            </div>
          </div>
        </section>

        {{-- BUMDes --}}
        <section id="perdes" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Perdes Desa (BUMDesa)</h2>
                <p class="sec-sub">Dokumen Perdes terkait BUMDesa: pendirian dan penyertaan modal.</p>
              </div>
              <span class="chip">Perdes BUMDesa</span>
            </div>

            <div class="doc-grid">
              @php $renderDoc('bumdes_pendirian_2018', 'doc-bumdes-2018'); @endphp
              @php $renderDoc('bumdes_modal_2024', 'doc-bumdes-2024'); @endphp
            </div>
          </div>
        </section>
        {{-- ================= VIDEO DOKUMENTER ================= --}}
<section id="video-desa" class="card section">
  <div class="card-pad">
    <div class="sec-head">
      <div>
        <h2 class="sec-title">Video Dokumenter Desa</h2>
        <p class="sec-sub">
          Dokumentasi resmi kegiatan, pembangunan, dan potensi unggulan Desa Suriamedal.
        </p>
      </div>
      <span class="chip">Dokumentasi</span>
    </div>

    <div style="margin-top:14px; border-radius:20px; overflow:hidden; box-shadow:0 12px 30px rgba(0,0,0,.12);">
      <iframe 
        width="100%" 
        height="500"
        src="https://www.youtube.com/embed/NZI6q2AXt2E"
        title="Video Dokumenter Desa"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen>
      </iframe>
    </div>

  </div>
</section>

{{-- ================= END VIDEO ================= --}}

      </main>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
(function(){
  window.printPdf = function(url){
    const w = window.open(url, '_blank', 'noopener');
    if(!w) return;
    w.addEventListener('load', () => { try { w.print(); } catch(e){} });
  };

  window.toggleViewer = function(id){
    const viewer = document.querySelector('[data-viewer="'+id+'"]');
    if(!viewer) return;
    viewer.style.display = (viewer.style.display === 'none') ? '' : 'none';
  };

  // Scrollspy
  const nav = document.getElementById('prNav');
  if(nav){
    const links = Array.from(nav.querySelectorAll('a[data-target]'));
    const sections = links.map(a => document.getElementById(a.dataset.target)).filter(Boolean);

    const setActive = (id) => {
      links.forEach(a => a.classList.toggle('is-active', a.dataset.target === id));
    };

    const obs = new IntersectionObserver((entries)=>{
      const visible = entries
        .filter(e => e.isIntersecting)
        .sort((a,b)=>b.intersectionRatio-a.intersectionRatio);
      if(visible[0]) setActive(visible[0].target.id);
    }, { rootMargin: "-18% 0px -72% 0px", threshold: [0.12,0.2,0.35,0.5] });

    sections.forEach(s => obs.observe(s));
  }

  // Charts
  if(typeof Chart === 'undefined') return;

  Chart.defaults.font.family = 'ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial';
  Chart.defaults.color = '#334155';

  const data = @json($prodeskel);

  // Pop compare
  (function(){
    const el = document.getElementById('popCompareChart');
    if(!el) return;

    const tIni  = data.kependudukan.tahun_ini;
    const tLalu = data.kependudukan.tahun_lalu;

    new Chart(el, {
      type: 'bar',
      data: {
        labels: ['Laki-laki', 'Perempuan', 'Total'],
        datasets: [
          { label: 'Tahun Ini',  data: [tIni.male, tIni.female, tIni.total],  borderRadius: 10, borderSkipped:false },
          { label: 'Tahun Lalu', data: [tLalu.male, tLalu.female, tLalu.total], borderRadius: 10, borderSkipped:false }
        ]
      },
      options: {
        responsive:true,
        plugins: { legend: { position:'bottom' } },
        scales: { y: { beginAtZero:true }, x: { grid: { display:false } } }
      }
    });
  })();

  // Budget pie
  (function(){
    const el = document.getElementById('budgetPieChart');
    if(!el) return;

    const b = data.anggaran.belanja;
    new Chart(el, {
      type: 'doughnut',
      data: { labels: b.map(x=>x.nama), datasets: [{ data: b.map(x=>x.nilai), borderWidth:0, hoverOffset:10 }] },
      options: { responsive:true, cutout:'68%', plugins: { legend: { position:'bottom' } } }
    });
  })();
})();
</script>

@endsection
