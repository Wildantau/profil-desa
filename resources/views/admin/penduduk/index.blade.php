@extends('web.layouts.app')

@section('title','Data Penduduk • Desa Suriamedal')

@section('content')

<style>
/* =====================================================
   DATA STATISTIK PENDUDUK (PUBLIK)
   Gaya: Resmi • Ringkas • Informatif
   ===================================================== */

.stat-wrapper{
  max-width:1100px;
  margin:0 auto;
  padding:40px 20px;
}

.stat-header{
  margin-bottom:32px;
}

.stat-header h1{
  font-size:32px;
  margin-bottom:6px;
}

.stat-header p{
  color:#64748b;
  font-size:15px;
}

.stat-period{
  margin-top:6px;
  font-size:14px;
  color:#475569;
}

.stat-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:24px;
  margin-top:30px;
}

.stat-card{
  background:#ffffff;
  border-radius:18px;
  padding:26px;
  box-shadow:0 10px 28px rgba(0,0,0,.08);
}

.stat-card h4{
  font-size:14px;
  color:#64748b;
  margin-bottom:6px;
}

.stat-card strong{
  font-size:30px;
  color:#0f172a;
}

.stat-sub{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:24px;
  margin-top:40px;
}

.stat-note{
  margin-top:36px;
  font-size:14px;
  color:#475569;
  background:#f8fafc;
  padding:18px 22px;
  border-radius:14px;
}

@media(max-width:900px){
  .stat-grid,
  .stat-sub{
    grid-template-columns:repeat(2,1fr);
  }
}

@media(max-width:500px){
  .stat-grid,
  .stat-sub{
    grid-template-columns:1fr;
  }
}
</style>

<div class="stat-wrapper">

  {{-- HEADER --}}
  <div class="stat-header">
    <h1>Data Statistik Penduduk</h1>
    <p>
      Ringkasan data kependudukan Desa Suriamedal
      berdasarkan laporan resmi pemerintah desa.
    </p>
    <div class="stat-period">
      Periode: <strong>{{ $latest->nama_bulan }} {{ $latest->tahun }}</strong>
    </div>
  </div>

  {{-- DATA UTAMA --}}
  <div class="stat-grid">
    <div class="stat-card">
      <h4>Total Penduduk</h4>
      <strong>{{ number_format($latest->total) }}</strong>
    </div>

    <div class="stat-card">
      <h4>Laki-laki</h4>
      <strong>{{ number_format($latest->laki_laki) }}</strong>
    </div>

    <div class="stat-card">
      <h4>Perempuan</h4>
      <strong>{{ number_format($latest->perempuan) }}</strong>
    </div>

    <div class="stat-card">
      <h4>Total Keluarga</h4>
      <strong>–</strong>
    </div>
  </div>

  {{-- PERUBAHAN --}}
  <div class="stat-sub">
    <div class="stat-card">
      <h4>Kelahiran</h4>
      <strong>{{ number_format($latest->lahir) }}</strong>
    </div>

    <div class="stat-card">
      <h4>Meninggal</h4>
      <strong>{{ number_format($latest->meninggal) }}</strong>
    </div>

    <div class="stat-card">
      <h4>Pendatang</h4>
      <strong>{{ number_format($latest->datang) }}</strong>
    </div>

    <div class="stat-card">
      <h4>Pindah</h4>
      <strong>{{ number_format($latest->pindah) }}</strong>
    </div>
  </div>

  {{-- CATATAN --}}
  @if($latest->keterangan)
  <div class="stat-note">
    <strong>Catatan:</strong><br>
    {{ $latest->keterangan }}
  </div>
  @endif

  <div class="stat-note" style="margin-top:18px">
    Sumber data: Laporan resmi Pemerintah Desa Suriamedal.<br>
    Terakhir diperbarui: {{ $latest->updated_at->translatedFormat('d F Y') }}
  </div>

</div>

@endsection
