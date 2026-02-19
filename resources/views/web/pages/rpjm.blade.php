@extends('web.layouts.app')
@section('title','RPJMDes 2021–2026 • Portal Desa Suriamedal')

@section('content')

<style>
  :root{
    --ink:#0f172a;
    --muted:#64748b;
    --line:rgba(15,23,42,.10);

    --g1:rgba(34,197,94,.18);
    --g2:rgba(96,165,250,.18);
    --g3:rgba(168,85,247,.16);

    --card: rgba(255,255,255,.92);
    --shadow: 0 18px 45px rgba(2,6,23,.08);
    --shadow2: 0 10px 28px rgba(2,6,23,.06);

    --r16:16px;
    --r20:20px;
    --r24:24px;
  }

  .rpjm-wrap{
    width:100%;
    padding:46px 0 78px;
    background:
      radial-gradient(1000px 520px at 12% 0%, var(--g2), transparent 60%),
      radial-gradient(900px 480px at 90% 10%, var(--g1), transparent 55%),
      radial-gradient(900px 520px at 50% 100%, var(--g3), transparent 55%),
      linear-gradient(180deg, #f6f9ff, #f7fff8);
  }
  .container-max{ max-width:1200px; margin:0 auto; padding:0 16px; }

  /* ===== HERO ===== */
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
    position:absolute; inset:-70px -40px auto auto;
    width:260px; height:260px;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.18), transparent 60%),
      radial-gradient(circle at 70% 70%, rgba(96,165,250,.18), transparent 60%),
      radial-gradient(circle at 50% 50%, rgba(168,85,247,.12), transparent 60%);
    filter: blur(2px);
    transform: rotate(14deg);
    pointer-events:none;
  }

  .hero-top{ display:flex; gap:14px; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; }
  .brand{ display:flex; gap:12px; align-items:flex-start; }
  .mark{
    width:52px; height:52px; border-radius:18px;
    border:1px solid rgba(15,23,42,.12);
    background: linear-gradient(135deg, rgba(34,197,94,.20), rgba(96,165,250,.18), rgba(168,85,247,.14));
    box-shadow: 0 10px 24px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
    flex:0 0 auto;
  }
  .mark svg{ width:26px; height:26px; color: var(--ink); }
  .title{
    margin:0;
    font-size:34px;
    line-height:1.08;
    letter-spacing:-0.03em;
    font-weight:950;
    color:var(--ink);
  }
  @media(max-width:768px){ .title{ font-size:28px; } }
  .sub{
    margin:8px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.7;
    max-width:920px;
  }

  .actions{ display:flex; gap:10px; flex-wrap:wrap; align-items:center; }

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
  }
  .btn:hover{ transform: translateY(-1px); transition:.16s ease; }
  .btn svg{ width:18px; height:18px; }

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

  /* ===== LAYOUT ===== */
  .layout{
    display:grid;
    grid-template-columns: 1fr;
    gap:14px;
    margin-top:14px;
  }
  @media(min-width: 1000px){
    .layout{ grid-template-columns: 320px 1fr; align-items:start; }
  }

  /* ===== SIDENAV ===== */
  .side{
    position:sticky; top:18px;
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    padding:14px;
    backdrop-filter: blur(10px);
  }
  .side h3{ margin:0; font-size:14px; font-weight:950; color:var(--ink); letter-spacing:-.01em; }
  .side p{ margin:6px 0 10px; color:var(--muted); font-size:13px; line-height:1.6; }

  .nav{ display:flex; flex-direction:column; gap:8px; }
  .nav a{
    text-decoration:none;
    padding:10px 12px;
    border-radius: 14px;
    border:1px solid rgba(15,23,42,.10);
    background: rgba(248,250,252,.92);
    color:#334155;
    font-weight:900;
    font-size:13px;
    display:flex; justify-content:space-between; align-items:center;
  }
  .nav a:hover{ background: rgba(226,232,240,.9); transform: translateY(-1px); transition:.16s ease; }
  .nav a.is-active{
    background: rgba(15,23,42,.92);
    color:#fff;
    border-color: rgba(15,23,42,.12);
  }
  .nav a.is-active small{ color: rgba(255,255,255,.75); }
  .nav small{ color:var(--muted); font-weight:900; }

  /* ===== CONTENT CARDS ===== */
  .card{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .card-pad{ padding:16px; }
  .section{ scroll-margin-top: 92px; }

  .sec-head{ display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap; }
  .sec-title{ margin:0; font-weight:950; color:var(--ink); letter-spacing:-.01em; font-size:16px; }
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

  /* ===== GRID SUMMARY ===== */
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

  /* ===== ACCORDION ===== */
  details.acc{
    margin-top:12px;
    border:1px solid rgba(226,232,240,.95);
    border-radius: 18px;
    background: rgba(255,255,255,.92);
    overflow:hidden;
  }
  details.acc summary{
    list-style:none;
    cursor:pointer;
    padding:12px 14px;
    font-weight:950;
    color:var(--ink);
    display:flex; align-items:center; justify-content:space-between; gap:10px;
    background:
      radial-gradient(520px 140px at 10% 0%, rgba(96,165,250,.12), transparent 60%),
      radial-gradient(520px 140px at 90% 0%, rgba(34,197,94,.10), transparent 60%),
      rgba(255,255,255,.85);
  }
  details.acc summary::-webkit-details-marker{ display:none; }
  .acc-body{ padding:14px; color:#334155; font-size:14px; line-height:1.75; }
  .acc-body ul{ margin:8px 0 0 18px; color:#334155; }
  .acc-body li{ margin:6px 0; }

  /* ===== CALLOUT ===== */
  .callout{
    margin-top:12px;
    border:1px solid rgba(226,232,240,.9);
    border-radius:18px;
    padding:14px;
    background: rgba(255,255,255,.92);
    box-shadow: 0 10px 26px rgba(2,6,23,.05);
    color:#334155;
    font-size:13px;
    line-height:1.7;
  }
  .callout code{
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono","Courier New", monospace;
    font-size:12px;
    background: rgba(226,232,240,.6);
    padding:2px 6px;
    border-radius:8px;
  }

  /* ===== DOC PANEL ===== */
  .doc{
    margin-top:12px;
    border:1px solid rgba(226,232,240,.9);
    border-radius:18px;
    background: rgba(255,255,255,.92);
    box-shadow: 0 10px 26px rgba(2,6,23,.05);
    overflow:hidden;
  }
  .doc .top{
    padding:12px 14px;
    border-bottom:1px solid rgba(226,232,240,.85);
    display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;
    background:
      radial-gradient(520px 140px at 10% 0%, rgba(34,197,94,.10), transparent 60%),
      radial-gradient(520px 140px at 90% 0%, rgba(96,165,250,.10), transparent 60%),
      rgba(255,255,255,.88);
  }
  .doc .top b{ color:var(--ink); }
  .doc .body{ padding:14px; color:#334155; font-size:13px; line-height:1.7; }
  .doc .body .muted{ color:var(--muted); }

  @media print{
    .btn, .side{ display:none !important; }
    .rpjm-wrap{ padding:0; background:#fff; }
    .card{ box-shadow:none; backdrop-filter:none; background:#fff; }
    .hero{ box-shadow:none; }
  }
</style>

@php
  $meta = [
    'dokumen' => 'RPJMDesa',
    'desa' => 'Desa Suriamedal',
    'periode' => '2021–2026',
    'status' => 'Publik (Ringkasan + Unduhan)',
  ];

  $downloadUrl = \Illuminate\Support\Facades\Route::has('download-rpjm')
      ? route('download-rpjm')
      : asset('files/Perdes RPJMDesa 2021-2026.pdf');

  $backUrl = \Illuminate\Support\Facades\Route::has('profil')
      ? route('profil').'#bagian-rpjm'
      : url('/profil-desa#bagian-rpjm');

  $fileHint = 'public/files/Perdes RPJMDesa 2021-2026.pdf';
@endphp

<div class="rpjm-wrap">
  <div class="container-max">

    {{-- HERO --}}
    <div class="hero">
      <div class="hero-top">
        <div class="brand">
          <div class="mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M6 4h9l3 3v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              <path d="M15 4v4h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M7.5 12h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M7.5 16h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <h1 class="title">RPJMDes {{ $meta['periode'] }}</h1>
            <p class="sub">
              Halaman ini menyajikan ringkasan publik dokumen <b>{{ $meta['dokumen'] }}</b> sebagai acuan arah pembangunan desa.
              Untuk rincian lengkap (bab/lampiran), silakan unduh dokumen resmi.
            </p>
          </div>
        </div>

        <div class="actions">
          <a class="btn" href="{{ $backUrl }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali ke Profil
          </a>

          <a class="btn primary" href="{{ $downloadUrl }}" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 3v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M8 11l4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Unduh PDF RPJMDes
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
    </div>

    <div class="layout">

      {{-- SIDENAV --}}
      <aside class="side">
        <h3>Daftar Isi RPJMDes</h3>
        <p>Klik untuk lompat. Struktur dibuat ringkas dan mudah dipresentasikan.</p>
        <nav class="nav" id="rpjmNav">
          <a href="#s0">Ringkasan <small>Publik</small></a>
          <a href="#s1">Bab I <small>Pendahuluan</small></a>
          <a href="#s2">Bab II <small>Gambaran Umum</small></a>
          <a href="#s3">Bab III <small>Visi, Misi, Arah</small></a>
          <a href="#s4">Bab IV <small>Program Prioritas</small></a>
          <a href="#s5">Bab V <small>Indikatif & Pendanaan</small></a>
          <a href="#s6">Bab VI <small>Penutup</small></a>
        </nav>

        <div class="doc">
          <div class="top">
            <span class="chip">Dokumen</span>
            <b>Perdes RPJMDesa 2021–2026</b>
          </div>
          <div class="body">
            <div class="muted">Lokasi file:</div>
            <div><code>{{ $fileHint }}</code></div>
            <div class="muted" style="margin-top:10px;">
              Jika tombol unduh menghasilkan 404, biasanya karena nama file berbeda atau belum dipindahkan ke folder <code>public/files</code>.
            </div>
          </div>
        </div>
      </aside>

      {{-- CONTENT --}}
      <main style="display:flex; flex-direction:column; gap:14px;">

        {{-- Ringkasan --}}
        <section id="s0" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Ringkasan Dokumen (Publik)</h2>
                <p class="sec-sub">
                  Ringkasan ini membantu warga dan perangkat desa memahami “arah besar” RPJMDes tanpa membaca seluruh dokumen.
                  Detail lengkap tetap mengacu pada file resmi.
                </p>
              </div>
              <span class="chip">Periode: {{ $meta['periode'] }}</span>
            </div>

            <div class="grid-3">
              <div class="mini">
                <div class="k">Dokumen</div>
                <div class="v">{{ $meta['dokumen'] }}</div>
                <div class="s">Perencanaan jangka menengah desa</div>
              </div>
              <div class="mini">
                <div class="k">Wilayah</div>
                <div class="v">{{ $meta['desa'] }}</div>
                <div class="s">Kecamatan Sumedang • Kabupaten Sumedang</div>
              </div>
              <div class="mini">
                <div class="k">Status</div>
                <div class="v">{{ $meta['status'] }}</div>
                <div class="s">Ringkasan + dokumen unduhan</div>
              </div>
            </div>

            <div class="callout">
              <b>Catatan:</b> Isi ringkasan disusun untuk kebutuhan web statis (presentasi/layanan informasi publik).
              Jika kamu mau, nanti kita bisa bikin versi “lebih resmi” berbentuk tabel: <b>program → indikator → target → pendanaan</b> (diambil dari dokumen RPJMDes).
            </div>
          </div>
        </section>

        {{-- Bab I --}}
        <section id="s1" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Bab I — Pendahuluan</h2>
                <p class="sec-sub">Landasan, maksud, tujuan, dan ruang lingkup RPJMDes.</p>
              </div>
              <span class="chip">Bab I</span>
            </div>

            <details class="acc" open>
              <summary>
                <span>Isi pokok Bab I (ringkas)</span>
                <span>▾</span>
              </summary>
              <div class="acc-body">
                <ul>
                  <li><b>Latar belakang</b> penyusunan RPJMDes sebagai acuan pembangunan desa selama 6 tahun.</li>
                  <li><b>Tujuan</b>: pedoman arah kebijakan, prioritas program, dan penyusunan RKPDes tahunan.</li>
                  <li><b>Ruang lingkup</b>: kondisi desa, visi-misi, strategi, program, pendanaan, pelaksanaan, dan pengendalian.</li>
                  <li><b>Landasan</b>: mengacu regulasi desa dan perencanaan pembangunan.</li>
                </ul>
              </div>
            </details>
          </div>
        </section>

        {{-- Bab II --}}
        <section id="s2" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Bab II — Gambaran Umum Desa</h2>
                <p class="sec-sub">Profil umum, kondisi wilayah, kependudukan, potensi, dan masalah prioritas.</p>
              </div>
              <span class="chip">Bab II</span>
            </div>

            <details class="acc">
              <summary>
                <span>Isi pokok Bab II (ringkas)</span>
                <span>▾</span>
              </summary>
              <div class="acc-body">
                <ul>
                  <li><b>Wilayah</b>: batas, kondisi geografis, akses, serta sarana pendukung.</li>
                  <li><b>Kependudukan</b>: gambaran jumlah/struktur penduduk (mengacu data desa).</li>
                  <li><b>Potensi</b>: SDA, UMKM, dan potensi ekonomi lokal.</li>
                  <li><b>Masalah prioritas</b>: permasalahan utama yang ditangani melalui program RPJMDes.</li>
                </ul>
              </div>
            </details>
          </div>
        </section>

        {{-- Bab III --}}
        <section id="s3" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Bab III — Visi, Misi, Arah Kebijakan</h2>
                <p class="sec-sub">Visi–misi dan arah pembangunan (placeholder agar profesional).</p>
              </div>
              <span class="chip">Bab III</span>
            </div>

            <details class="acc">
              <summary>
                <span>Isi pokok Bab III (ringkas)</span>
                <span>▾</span>
              </summary>
              <div class="acc-body">
                <ul>
                  <li><b>Visi</b>: (placeholder — isi dari dokumen resmi RPJMDes).</li>
                  <li><b>Misi</b>: (placeholder — daftar misi sesuai dokumen).</li>
                  <li><b>Arah kebijakan</b>: penentuan prioritas sektor (infrastruktur, pelayanan, ekonomi, sosial, lingkungan).</li>
                  <li><b>Strategi</b>: pendekatan pencapaian target dan sinergi program lintas level.</li>
                </ul>
                <div style="margin-top:10px; color:#64748b;">
                  Bagian ini sengaja placeholder agar tidak mengisi nama/kalimat yang tidak sesuai dokumen. Nanti bisa kita isi dari PDF resmi.
                </div>
              </div>
            </details>
          </div>
        </section>

        {{-- Bab IV --}}
        <section id="s4" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Bab IV — Program Prioritas</h2>
                <p class="sec-sub">Garis besar program/kegiatan prioritas selama periode RPJMDes.</p>
              </div>
              <span class="chip">Bab IV</span>
            </div>

            <div class="grid-3">
              <div class="mini">
                <div class="k">Prioritas</div>
                <div class="v">Infrastruktur</div>
                <div class="s">Sarana prasarana dasar</div>
              </div>
              <div class="mini">
                <div class="k">Prioritas</div>
                <div class="v">Pelayanan</div>
                <div class="s">Layanan publik & administrasi</div>
              </div>
              <div class="mini">
                <div class="k">Prioritas</div>
                <div class="v">Ekonomi</div>
                <div class="s">UMKM & ekonomi lokal</div>
              </div>
            </div>

            <details class="acc">
              <summary>
                <span>Struktur bidang program (umum)</span>
                <span>▾</span>
              </summary>
              <div class="acc-body">
                <ul>
                  <li>Bidang Penyelenggaraan Pemerintahan Desa</li>
                  <li>Bidang Pelaksanaan Pembangunan Desa</li>
                  <li>Bidang Pembinaan Kemasyarakatan</li>
                  <li>Bidang Pemberdayaan Masyarakat</li>
                  <li>Bidang Penanggulangan Bencana/Darurat/Mendesak</li>
                </ul>
                <div style="margin-top:10px; color:#64748b;">
                  Kalau kamu setuju, tahap berikutnya kita buat <b>tabel prioritas</b> (program → indikator → target → sumber dana) agar lebih “resmi”.
                </div>
              </div>
            </details>
          </div>
        </section>

        {{-- Bab V --}}
        <section id="s5" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Bab V — Indikatif & Pendanaan</h2>
                <p class="sec-sub">Kerangka pendanaan indikatif dan sumber pembiayaan program.</p>
              </div>
              <span class="chip">Bab V</span>
            </div>

            <details class="acc">
              <summary>
                <span>Isi pokok Bab V (ringkas)</span>
                <span>▾</span>
              </summary>
              <div class="acc-body">
                <ul>
                  <li><b>Sumber</b>: Dana Desa, ADD, bantuan prov/kab, PADes, dan sumber sah lainnya.</li>
                  <li><b>Prinsip</b>: transparansi, akuntabilitas, prioritas kebutuhan masyarakat, sesuai regulasi.</li>
                  <li><b>Alur</b>: RPJMDes → RKPDes → APBDes tahunan.</li>
                </ul>
              </div>
            </details>
          </div>
        </section>

        {{-- Bab VI --}}
        <section id="s6" class="card section">
          <div class="card-pad">
            <div class="sec-head">
              <div>
                <h2 class="sec-title">Bab VI — Penutup</h2>
                <p class="sec-sub">Penegasan komitmen pelaksanaan RPJMDes dan ajakan partisipasi masyarakat.</p>
              </div>
              <span class="chip">Bab VI</span>
            </div>

            <details class="acc">
              <summary>
                <span>Isi pokok Bab VI (ringkas)</span>
                <span>▾</span>
              </summary>
              <div class="acc-body">
                <ul>
                  <li>RPJMDes menjadi pedoman pembangunan desa selama periode berjalan.</li>
                  <li>Pelaksanaan bertahap melalui RKPDes dan APBDes tiap tahun.</li>
                  <li>Partisipasi masyarakat penting agar program tepat sasaran.</li>
                </ul>
              </div>
            </details>

            <div class="callout">
              <b>Dokumen resmi:</b> gunakan tombol <b>Unduh PDF RPJMDes</b>.
              File disimpan di <code>{{ $fileHint }}</code>.
            </div>
          </div>
        </section>

      </main>
    </div>

  </div>
</div>

<script>
(function(){
  // Highlight sidenav sesuai section yang sedang terlihat
  const nav = document.getElementById('rpjmNav');
  if(!nav) return;

  const links = Array.from(nav.querySelectorAll('a'));
  const sections = links
    .map(a => document.querySelector(a.getAttribute('href')))
    .filter(Boolean);

  const setActive = (id) => {
    links.forEach(a => {
      const href = a.getAttribute('href');
      a.classList.toggle('is-active', href === '#' + id);
    });
  };

  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting){
        setActive(e.target.id);
      }
    });
  }, { root:null, threshold:0.45 });

  sections.forEach(s => io.observe(s));
})();
</script>

@endsection
