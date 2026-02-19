@extends('web.layouts.app')
@section('title','Data Penduduk • Portal Desa Suriamedal')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
  --primary:#0f766e;
  --ink:#0f172a;
  --muted:#475569;
  --bg:#f8fafc;
  --card:#ffffff;
  --shadow:0 18px 45px rgba(0,0,0,.12);
}
.container{ max-width:1200px; margin:auto; padding:50px 20px 90px; }
.header{
  background:linear-gradient(135deg,#0f766e,#16a34a);
  color:#fff;
  padding:48px;
  border-radius:22px;
  box-shadow:var(--shadow);
}
.section{ margin-top:56px; }
.section-title{
  font-size:22px;
  font-weight:900;
  margin-bottom:20px;
  border-left:6px solid var(--primary);
  padding-left:14px;
}
.cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:22px;
}
.card{
  background:var(--card);
  padding:26px;
  border-radius:18px;
  box-shadow:var(--shadow);
}
.card small{ color:var(--muted); font-weight:700; }
.card .value{ font-size:30px; font-weight:900; color:var(--primary); }
.grid-2{ display:grid; grid-template-columns:1fr 1fr; gap:30px; }
.chart-box{
  background:#fff;
  border-radius:20px;
  padding:26px;
  box-shadow:var(--shadow);
}
@media(max-width:900px){ .grid-2{ grid-template-columns:1fr; } }
</style>

<div class="container">

  <div class="header">
    <h1>Statistik Kependudukan Desa Suriamedal</h1>
    <p>Data resmi berbasis <strong>Smart Village</strong>.</p>
  </div>

  @if(!$statistik)
    <div class="section"><strong>Belum ada data statistik.</strong></div>
  @else

  <div class="section">
    <div class="section-title">Ringkasan Penduduk</div>
    <div class="cards">
      <div class="card"><small>Total</small><div class="value">{{ number_format($statistik->total) }}</div></div>
      <div class="card"><small>Laki-laki</small><div class="value">{{ number_format($statistik->laki_laki) }}</div></div>
      <div class="card"><small>Perempuan</small><div class="value">{{ number_format($statistik->perempuan) }}</div></div>
      <div class="card"><small>Periode</small><div class="value">{{ $statistik->nama_bulan }} {{ $statistik->tahun }}</div></div>
    </div>
  </div>

  <div class="section grid-2">
    <div class="chart-box"><canvas id="genderChart"></canvas></div>
    <div class="chart-box"><canvas id="usiaChart"></canvas></div>
  </div>

  <div class="section grid-2">
    <div class="chart-box"><canvas id="pekerjaanChart"></canvas></div>
    <div class="chart-box"><canvas id="pendidikanChart"></canvas></div>
  </div>

  <div class="section">
    <div class="chart-box" style="max-width:600px"><canvas id="agamaChart"></canvas></div>
  </div>

  @endif
</div>

<script>
const chartPenduduk = @json($chartPenduduk);
const usia        = @json($usia);
const pekerjaan   = @json($pekerjaan);
const pendidikan  = @json($pendidikan);
const agama       = @json($agama);

new Chart(genderChart,{
  type:'doughnut',
  data:{ labels:chartPenduduk.labels, datasets:[{ data:chartPenduduk.data }] }
});

new Chart(usiaChart,{
  type:'bar',
  data:{ labels:Object.keys(usia), datasets:[{ data:Object.values(usia) }] }
});

new Chart(pekerjaanChart,{
  type:'bar',
  data:{ labels:Object.keys(pekerjaan), datasets:[{ data:Object.values(pekerjaan) }] }
});

new Chart(pendidikanChart,{
  type:'bar',
  data:{ labels:Object.keys(pendidikan), datasets:[{ data:Object.values(pendidikan) }] }
});

new Chart(agamaChart,{
  type:'pie',
  data:{ labels:Object.keys(agama), datasets:[{ data:Object.values(agama) }] }
});
</script>

@endsection
