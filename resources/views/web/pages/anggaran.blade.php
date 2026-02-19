@extends('web.layouts.app')
@section('title','Anggaran Desa • Portal Desa Suriamedal')

@section('content')

<style>
  :root{
    --ink:#0f172a;
    --muted:#64748b;
    --line:rgba(15,23,42,.10);

    --g1:rgba(34,197,94,.18);
    --g2:rgba(96,165,250,.18);
    --g3:rgba(168,85,247,.16);

    --shadow: 0 18px 45px rgba(2,6,23,.08);
    --shadow2: 0 10px 30px rgba(2,6,23,.06);
    --r16:16px; --r18:18px; --r22:22px;
  }

  .ang-wrap{
    width:100%;
    padding:46px 0 78px;
    background:
      radial-gradient(1000px 520px at 12% 0%, var(--g2), transparent 60%),
      radial-gradient(900px 480px at 90% 10%, var(--g1), transparent 55%),
      radial-gradient(900px 520px at 50% 100%, var(--g3), transparent 55%),
      linear-gradient(180deg, #f6f9ff, #f7fff8);
  }
  .container-max{ max-width:1200px; margin:0 auto; padding:0 16px; }

  .head{ text-align:center; padding: 6px 0 18px; }
  .title{
    margin:0;
    font-size:46px;
    line-height:1.06;
    letter-spacing:-0.03em;
    font-weight:950;
    color:var(--ink);
  }
  @media(max-width:768px){ .title{ font-size:34px; } }
  .sub{
    margin:10px auto 0;
    max-width:920px;
    color:var(--muted);
    line-height:1.7;
    font-size:15px;
  }

  .topbar{
    margin-top:18px;
    display:flex;
    gap:12px;
    justify-content:space-between;
    align-items:stretch;
    flex-wrap:wrap;
  }
  .hint{
    flex:1;
    min-width:260px;
    background:rgba(255,255,255,.90);
    border:1px solid var(--line);
    border-radius:18px;
    padding:12px 14px;
    box-shadow: var(--shadow2);
    backdrop-filter: blur(10px);
    color:#475569;
    font-size:13px;
    line-height:1.6;
  }
  .hint b{ color:var(--ink); }

  .actions{
    display:flex; gap:10px; flex-wrap:wrap;
    align-items:center; justify-content:center;
    margin-top:14px;
  }
  .btn{
    appearance:none; border:none; cursor:pointer;
    padding:10px 12px;
    border-radius:14px;
    font-weight:950;
    font-size:13px;
    color:var(--ink);
    background: rgba(255,255,255,.92);
    border:1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    text-decoration:none;
    display:inline-flex; gap:10px; align-items:center;
  }
  .btn:hover{ transform: translateY(-1px); transition:.16s ease; }
  .btn.dark{ background: rgba(15,23,42,.92); color:#fff; border-color: rgba(15,23,42,.12); }
  .btn svg{ width:18px; height:18px; }

  .chip{
    display:inline-flex; align-items:center;
    padding:7px 10px;
    border-radius:999px;
    border:1px solid rgba(15,23,42,.08);
    background:rgba(248,250,252,.9);
    font-weight:950;
    font-size:12px;
    color:#334155;
    white-space:nowrap;
  }
  .chip.green{ background:rgba(34,197,94,.10); border-color:rgba(34,197,94,.22); color:#065f46; }
  .chip.blue{ background:rgba(96,165,250,.12); border-color:rgba(96,165,250,.22); color:#1d4ed8; }
  .chip.purple{ background:rgba(168,85,247,.12); border-color:rgba(168,85,247,.22); color:#6d28d9; }

  .grid-4{ display:grid; grid-template-columns:1fr; gap:14px; margin-top:16px; }
  @media (min-width: 900px){ .grid-4{ grid-template-columns:repeat(4, 1fr); } }

  .grid-2{ display:grid; grid-template-columns:1fr; gap:14px; margin-top:14px; }
  @media (min-width: 900px){ .grid-2{ grid-template-columns: 7fr 5fr; } }

  .card{
    background:rgba(255,255,255,.92);
    border:1px solid var(--line);
    border-radius:22px;
    box-shadow: var(--shadow);
    overflow:hidden;
    position:relative;
    backdrop-filter: blur(10px);
  }
  .card-pad{ padding:16px; }
  .card-title{
    margin:0;
    font-size:16px;
    font-weight:950;
    color:var(--ink);
    letter-spacing:-0.01em;
  }
  .muted{ color:var(--muted); font-size:13px; line-height:1.6; }

  .stat{ display:flex; align-items:center; gap:12px; }
  .stat-icon{
    width:46px; height:46px;
    border-radius:16px;
    display:flex; align-items:center; justify-content:center;
    flex:0 0 auto;
    border: 1px solid rgba(15,23,42,.10);
    background: linear-gradient(135deg, rgba(96,165,250,.18), rgba(34,197,94,.14));
    color:var(--ink);
  }
  .stat-icon.green{ background: linear-gradient(135deg, rgba(34,197,94,.20), rgba(6,182,212,.16)); border-color:rgba(34,197,94,.22); color:#047857; }
  .stat-icon.blue{ background: linear-gradient(135deg, rgba(96,165,250,.22), rgba(168,85,247,.16)); border-color:rgba(96,165,250,.22); color:#1d4ed8; }
  .stat-icon.purple{ background: linear-gradient(135deg, rgba(168,85,247,.22), rgba(96,165,250,.14)); border-color:rgba(168,85,247,.22); color:#6d28d9; }
  .stat-icon.gray{ background: linear-gradient(135deg, rgba(148,163,184,.18), rgba(226,232,240,.28)); border-color:rgba(100,116,139,.18); color:#334155; }
  .stat-icon svg{ width:22px; height:22px; }

  .k{ font-size:11px; color:var(--muted); font-weight:950; letter-spacing:.12em; text-transform:uppercase; }
  .v{ font-size:26px; font-weight:950; color:var(--ink); margin-top:2px; }
  .s{ font-size:12px; color:var(--muted); margin-top:2px; }

  .box{
    border:1px solid rgba(226,232,240,.9);
    border-radius:18px;
    padding:14px;
    background:rgba(255,255,255,.92);
    box-shadow: 0 10px 26px rgba(2,6,23,.05);
  }

  .table-wrap{
    margin-top:12px;
    overflow:auto;
    border-radius:18px;
    border:1px solid rgba(226,232,240,.9);
    background:rgba(255,255,255,.92);
  }
  table{ width:100%; border-collapse:separate; border-spacing:0; min-width:780px; }
  @media(min-width:900px){ table{ min-width:900px; } }

  thead th{
    text-align:left;
    font-size:11px;
    letter-spacing:.14em;
    color:var(--muted);
    font-weight:950;
    padding:14px 14px;
    border-bottom:1px solid rgba(226,232,240,.85);
    background:rgba(255,255,255,.95);
    position:sticky;
    top:0;
    z-index:1;
    text-transform:uppercase;
    white-space:nowrap;
  }
  tbody td{
    padding:14px 14px;
    border-bottom:1px solid rgba(226,232,240,.70);
    color:var(--ink);
    font-size:14px;
    vertical-align:middle;
    background:rgba(255,255,255,.88);
  }
  tbody tr:hover td{ background:rgba(248,250,252,.95); }

  tfoot td{
    padding:14px 14px;
    background:rgba(248,250,252,.96);
    border-top:1px solid rgba(226,232,240,.85);
    color:var(--ink);
  }

  .num{ font-weight:950; color:var(--ink); white-space:nowrap; }

  .pill{
    display:inline-flex; align-items:center; gap:8px;
    padding:8px 11px;
    border-radius:999px;
    font-size:12px;
    font-weight:950;
    border:1px solid rgba(15,23,42,.08);
    background:rgba(248,250,252,.9);
    color:#334155;
    white-space:nowrap;
  }
  .pill.green{ background:rgba(34,197,94,.10); border-color:rgba(34,197,94,.20); color:#065f46; }
  .pill.blue{ background:rgba(96,165,250,.12); border-color:rgba(96,165,250,.20); color:#1d4ed8; }
  .pill.purple{ background:rgba(168,85,247,.12); border-color:rgba(168,85,247,.22); color:#6d28d9; }

  .progress{
    margin-top:12px;
    height:12px;
    border-radius:999px;
    background: rgba(226,232,240,.8);
    overflow:hidden;
    border:1px solid rgba(15,23,42,.06);
  }
  .progress > span{
    display:block;
    height:100%;
    width:0%;
    border-radius:999px;
    background: linear-gradient(90deg, rgba(34,197,94,.90), rgba(96,165,250,.90), rgba(168,85,247,.85));
    transition: width .35s ease;
  }

  .sp-12{ height:12px; }
</style>

@php
  /**
   * ==========================================================
   * DATA ANGGARAN (DUMMY UNTUK TAMPILAN PUBLIK)
   * Nanti kalau sudah ada ADMIN: ambil dari database.
   * ==========================================================
   */
  $tahun = 2026;

  // Contoh struktur: penerimaan & belanja per kelompok
  $penerimaan = [
    ['nama'=>'Pendapatan Asli Desa (PADes)', 'nilai'=> 150000000],
    ['nama'=>'Dana Desa', 'nilai'=> 900000000],
    ['nama'=>'Alokasi Dana Desa', 'nilai'=> 450000000],
    ['nama'=>'Bagi Hasil Pajak & Retribusi', 'nilai'=> 75000000],
    ['nama'=>'Bantuan Keuangan Provinsi/Kabupaten', 'nilai'=> 120000000],
    ['nama'=>'Lain-lain Pendapatan yang Sah', 'nilai'=> 25000000],
  ];

  $belanja = [
    ['nama'=>'Penyelenggaraan Pemerintahan Desa', 'nilai'=> 420000000],
    ['nama'=>'Pelaksanaan Pembangunan Desa', 'nilai'=> 780000000],
    ['nama'=>'Pembinaan Kemasyarakatan', 'nilai'=> 110000000],
    ['nama'=>'Pemberdayaan Masyarakat', 'nilai'=> 210000000],
    ['nama'=>'Belanja Tak Terduga', 'nilai'=> 50000000],
  ];

  $totalPenerimaan = collect($penerimaan)->sum('nilai');
  $totalBelanja    = collect($belanja)->sum('nilai');
  $saldo           = $totalPenerimaan - $totalBelanja;

  $porsiPembangunan = $totalBelanja ? round(($belanja[1]['nilai'] / $totalBelanja) * 100, 1) : 0;

  function rupiah($n){
    return 'Rp ' . number_format($n, 0, ',', '.');
  }
@endphp

<div class="ang-wrap">
  <div class="container-max">

    <div class="head">
      <h1 class="title">Anggaran Desa</h1>
      <p class="sub">
        Halaman ini ditampilkan untuk mendukung <b>transparansi</b> pengelolaan keuangan Desa <b>Suriamedal</b>.
        Data akan diperbarui melalui <b>panel admin</b> ketika terdapat perubahan resmi.
      </p>

      <div class="actions">
        <a class="btn dark" href="{{ route('profil') }}#bagian-anggaran">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Kembali ke Profil
        </a>

        <button class="btn" type="button" onclick="window.print()">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M6 9V4h12v5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M6 14h12v6H6z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Cetak / Save PDF
        </button>
      </div>

      <div class="topbar">
        <div class="hint">
          <b>Catatan:</b> Ini adalah tampilan publik. Rincian dapat diperluas (per kegiatan) sesuai kebutuhan desa.
          <div class="sp-12"></div>
          <span class="chip green">Tahun: {{ $tahun }}</span>
          <span class="chip blue" style="margin-left:6px;">Format: Ringkas + Tabel</span>
          <span class="chip purple" style="margin-left:6px;">Status: Publik</span>
        </div>
      </div>
    </div>

    {{-- KPI --}}
    <div class="grid-4">
      <div class="card card-pad">
        <div class="stat">
          <div class="stat-icon green" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 1v22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M7 6h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M7 18h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <div class="k">TOTAL PENERIMAAN</div>
            <div class="v">{{ rupiah($totalPenerimaan) }}</div>
            <div class="s">Akumulasi sumber pendapatan</div>
          </div>
        </div>
      </div>

      <div class="card card-pad">
        <div class="stat">
          <div class="stat-icon blue" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 20V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M10 20V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M16 20v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M22 20v-12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <div class="k">TOTAL BELANJA</div>
            <div class="v">{{ rupiah($totalBelanja) }}</div>
            <div class="s">Total belanja per kelompok</div>
          </div>
        </div>
      </div>

      <div class="card card-pad">
        <div class="stat">
          <div class="stat-icon purple" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 2l3 7h7l-5.6 4.2L18.5 21 12 16.9 5.5 21l2.1-7.8L2 9h7l3-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <div class="k">SALDO (SURPLUS/DEFISIT)</div>
            <div class="v">{{ rupiah($saldo) }}</div>
            <div class="s">Penerimaan - Belanja</div>
          </div>
        </div>
      </div>

      <div class="card card-pad">
        <div class="stat">
          <div class="stat-icon gray" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 12h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M4 6h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M4 18h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <div class="k">PORSI PEMBANGUNAN</div>
            <div class="v">{{ $porsiPembangunan }}%</div>
            <div class="s">Belanja pembangunan / total</div>
          </div>
        </div>
      </div>
    </div>

    {{-- RINGKASAN + GRAFIK --}}
    <div class="grid-2">
      <div class="card card-pad">
        <h3 class="card-title">Ringkasan Visual</h3>
        <div class="muted" style="margin-top:6px;">
          Grafik dibuat supaya tidak monoton: donut penerimaan & donut belanja (mudah dipresentasikan).
        </div>

        <div class="sp-12"></div>

        <div class="box">
          <div style="display:flex; gap:10px; flex-wrap:wrap; justify-content:space-between; align-items:center;">
            <span class="pill green">Penerimaan</span>
            <span class="pill blue">Belanja</span>
            <span class="pill purple">Tahun {{ $tahun }}</span>
          </div>

          <div class="sp-12"></div>

          <div style="display:grid; grid-template-columns:1fr; gap:14px;">
            <canvas id="chartPenerimaan" height="260"></canvas>
            <canvas id="chartBelanja" height="260"></canvas>
          </div>

          <div class="muted" style="margin-top:10px;">
            Tips presentasi: jelaskan dulu total penerimaan & belanja, lalu tunjuk porsi terbesar (mis. Dana Desa dan Pembangunan).
          </div>
        </div>
      </div>

      <div class="card card-pad">
        <h3 class="card-title">Catatan Transparansi</h3>
        <div class="muted" style="margin-top:6px;">
          Halaman publik menampilkan ringkasan yang mudah dipahami. Detail lengkap dapat ditambahkan (per kegiatan) sesuai dokumen resmi.
        </div>

        <div class="sp-12"></div>

        <div class="box">
          <div class="k">Kelengkapan Data</div>
          <div class="muted" style="margin-top:6px;">
            Data anggaran akan diperbarui melalui panel admin saat ada perubahan. Untuk publik, fokus pada ringkasan utama agar mudah dibaca.
          </div>

          <div class="progress" aria-label="progress kelengkapan">
            <span id="progressFill"></span>
          </div>

          <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:12px;">
            <span class="chip green">Transparan</span>
            <span class="chip blue">Mudah dipahami</span>
            <span class="chip purple">Siap dikembangkan</span>
          </div>
        </div>
      </div>
    </div>

    {{-- TABEL PENERIMAAN --}}
    <div class="card card-pad" style="margin-top:14px;">
      <h3 class="card-title">Rincian Penerimaan</h3>
      <div class="muted" style="margin-top:6px;">Sumber pendapatan desa (ringkas).</div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width:70px;">No</th>
              <th>Sumber</th>
              <th style="width:220px;">Nilai</th>
              <th style="width:140px;">Porsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($penerimaan as $i => $row)
              @php $pct = $totalPenerimaan ? round(($row['nilai']/$totalPenerimaan)*100, 1) : 0; @endphp
              <tr>
                <td class="num">{{ $i+1 }}</td>
                <td>{{ $row['nama'] }}</td>
                <td class="num">{{ rupiah($row['nilai']) }}</td>
                <td><span class="pill green">{{ $pct }}%</span></td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" class="num">TOTAL</td>
              <td class="num">{{ rupiah($totalPenerimaan) }}</td>
              <td class="num">100%</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    {{-- TABEL BELANJA --}}
    <div class="card card-pad" style="margin-top:14px;">
      <h3 class="card-title">Rincian Belanja</h3>
      <div class="muted" style="margin-top:6px;">Kelompok belanja desa (ringkas).</div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width:70px;">No</th>
              <th>Kelompok Belanja</th>
              <th style="width:220px;">Nilai</th>
              <th style="width:140px;">Porsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($belanja as $i => $row)
              @php $pct = $totalBelanja ? round(($row['nilai']/$totalBelanja)*100, 1) : 0; @endphp
              <tr>
                <td class="num">{{ $i+1 }}</td>
                <td>{{ $row['nama'] }}</td>
                <td class="num">{{ rupiah($row['nilai']) }}</td>
                <td><span class="pill blue">{{ $pct }}%</span></td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" class="num">TOTAL</td>
              <td class="num">{{ rupiah($totalBelanja) }}</td>
              <td class="num">100%</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
(function(){
  if(typeof Chart === 'undefined'){
    console.warn('Chart.js gagal dimuat. Pastikan koneksi / CDN tidak diblok.');
    return;
  }

  const fmt = (n)=> new Intl.NumberFormat('id-ID').format(n);

  // DATA dari Blade
  const penerimaan = @json($penerimaan);
  const belanja = @json($belanja);
  const totalP = {{ $totalPenerimaan }};
  const totalB = {{ $totalBelanja }};

  // Default feel
  Chart.defaults.font.family = 'ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial';
  Chart.defaults.color = '#334155';

  function grad(ctx, area, c1, c2){
    if(!area) return c1;
    const g = ctx.createLinearGradient(area.left, area.top, area.right, area.bottom);
    g.addColorStop(0, c1);
    g.addColorStop(1, c2);
    return g;
  }

  // PENERIMAAN donut
  (function(){
    const el = document.getElementById('chartPenerimaan');
    if(!el) return;
    const ctx = el.getContext('2d');

    new Chart(el,{
      type:'doughnut',
      data:{
        labels: penerimaan.map(x=>x.nama),
        datasets:[{
          data: penerimaan.map(x=>x.nilai),
          backgroundColor: (c)=>{
            const area = c.chart.chartArea;
            return penerimaan.map((_,i)=>{
              const variants = [
                grad(ctx, area, 'rgba(34,197,94,.92)','rgba(6,182,212,.78)'),
                grad(ctx, area, 'rgba(96,165,250,.92)','rgba(168,85,247,.78)'),
                grad(ctx, area, 'rgba(168,85,247,.88)','rgba(34,197,94,.70)'),
                grad(ctx, area, 'rgba(249,115,22,.88)','rgba(96,165,250,.72)'),
              ];
              return variants[i % variants.length];
            });
          },
          borderWidth:0,
          hoverOffset:10
        }]
      },
      options:{
        responsive:true,
        cutout:'70%',
        plugins:{
          legend:{ position:'bottom', labels:{ boxWidth:10, boxHeight:10, usePointStyle:true, pointStyle:'circle' } },
          tooltip:{ callbacks:{
            label:(c)=>{
              const val = c.raw || 0;
              const pct = totalP ? ((val/totalP)*100).toFixed(1) : '0.0';
              return `${c.label}: Rp ${fmt(val)} (${pct}%)`;
            }
          }}
        }
      }
    });
  })();

  // BELANJA donut
  (function(){
    const el = document.getElementById('chartBelanja');
    if(!el) return;
    const ctx = el.getContext('2d');

    new Chart(el,{
      type:'doughnut',
      data:{
        labels: belanja.map(x=>x.nama),
        datasets:[{
          data: belanja.map(x=>x.nilai),
          backgroundColor: (c)=>{
            const area = c.chart.chartArea;
            return belanja.map((_,i)=>{
              const variants = [
                grad(ctx, area, 'rgba(96,165,250,.92)','rgba(34,197,94,.78)'),
                grad(ctx, area, 'rgba(168,85,247,.90)','rgba(96,165,250,.74)'),
                grad(ctx, area, 'rgba(6,182,212,.90)','rgba(34,197,94,.74)'),
                grad(ctx, area, 'rgba(249,115,22,.88)','rgba(168,85,247,.72)'),
              ];
              return variants[i % variants.length];
            });
          },
          borderWidth:0,
          hoverOffset:10
        }]
      },
      options:{
        responsive:true,
        cutout:'70%',
        plugins:{
          legend:{ position:'bottom', labels:{ boxWidth:10, boxHeight:10, usePointStyle:true, pointStyle:'circle' } },
          tooltip:{ callbacks:{
            label:(c)=>{
              const val = c.raw || 0;
              const pct = totalB ? ((val/totalB)*100).toFixed(1) : '0.0';
              return `${c.label}: Rp ${fmt(val)} (${pct}%)`;
            }
          }}
        }
      }
    });
  })();

  // progress (sekedar feel kelengkapan)
  const progress = document.getElementById('progressFill');
  if(progress){
    const pct = (penerimaan.length && belanja.length) ? 85 : 55;
    progress.style.width = pct + '%';
  }
})();
</script>

@endsection
