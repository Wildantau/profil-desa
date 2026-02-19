@extends('admin.layouts.app')

@section('title', 'Dashboard Admin Desa')

@push('styles')
<style>
.dashboard-wrap{
  background:#f8fafc;
  padding:32px;
  border-radius:20px;
}

.db-head{
  display:flex;
  justify-content:space-between;
  align-items:flex-end;
  margin-bottom:30px;
}

.db-title{
  font-size:28px;
  font-weight:900;
}

.db-sub{
  font-size:14px;
  color:#64748b;
}

.btn{
  padding:8px 16px;
  border-radius:999px;
  font-weight:700;
  font-size:13px;
  text-decoration:none;
  border:1px solid #e2e8f0;
  background:#fff;
  color:#0f172a;
}

.btn.primary{
  background:#2563eb;
  color:#fff;
  border-color:#2563eb;
}

.section-title{
  margin:30px 0 15px;
  font-size:18px;
  font-weight:800;
}

.stats-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:16px;
}

.stat-card{
  background:#fff;
  border-radius:16px;
  padding:20px;
  border:1px solid #e2e8f0;
  box-shadow:0 8px 20px rgba(0,0,0,.04);
}

.stat-card .label{
  font-size:12px;
  font-weight:800;
  color:#64748b;
  text-transform:uppercase;
}

.stat-card .value{
  font-size:30px;
  font-weight:900;
  margin-top:6px;
}

.stat-blue{ border-left:5px solid #2563eb; }
.stat-green{ border-left:5px solid #16a34a; }
.stat-red{ border-left:5px solid #dc2626; }
.stat-cyan{ border-left:5px solid #0891b2; }

.shortcut-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
  gap:16px;
  margin-top:15px;
}

.shortcut{
  background:#fff;
  border-radius:16px;
  padding:18px;
  border:1px solid #e2e8f0;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.shortcut b{
  font-size:15px;
}

.shortcut small{
  display:block;
  font-size:12px;
  color:#64748b;
}
</style>
@endpush

@section('content')

<div class="dashboard-wrap">

  {{-- HEADER --}}
  <div class="db-head">
    <div>
      <div class="db-title">Dashboard Admin Desa</div>
      <div class="db-sub">
        Ringkasan data resmi dan statistik desa.
      </div>
    </div>
    <div>
      <a class="btn primary" href="{{ route('admin.umkm.index') }}">
        Kelola UMKM
      </a>
    </div>
  </div>

  {{-- PERANGKAT DESA --}}
  <div class="section-title">Perangkat Desa</div>
  <div class="stats-grid">
    <div class="stat-card stat-blue">
      <div class="label">Total Perangkat</div>
      <div class="value">{{ $totalPerangkat }}</div>
    </div>
    <div class="stat-card stat-green">
      <div class="label">Aktif</div>
      <div class="value">{{ $aktifPerangkat }}</div>
    </div>
    <div class="stat-card stat-red">
      <div class="label">Nonaktif</div>
      <div class="value">{{ $nonaktifPerangkat }}</div>
    </div>
  </div>

  {{-- STATISTIK PENDUDUK --}}
  <div class="section-title">Statistik Penduduk</div>
  <div class="stats-grid">
    <div class="stat-card stat-cyan">
      <div class="label">Total Penduduk</div>
      <div class="value">{{ number_format($totalPenduduk) }}</div>
    </div>
    <div class="stat-card stat-blue">
      <div class="label">Laki-laki</div>
      <div class="value">{{ number_format($lakiLaki) }}</div>
    </div>
    <div class="stat-card stat-blue">
      <div class="label">Perempuan</div>
      <div class="value">{{ number_format($perempuan) }}</div>
    </div>
  </div>

  {{-- UMKM DESA --}}
  <div class="section-title">UMKM Desa</div>
  <div class="stats-grid">
    <div class="stat-card stat-blue">
      <div class="label">Total UMKM</div>
      <div class="value">{{ $totalUmkm }}</div>
    </div>
    <div class="stat-card stat-green">
      <div class="label">Ditampilkan</div>
      <div class="value">{{ $umkmPublik }}</div>
    </div>
    <div class="stat-card stat-red">
      <div class="label">Draft</div>
      <div class="value">{{ $umkmDraft }}</div>
    </div>
  </div>

  {{-- SHORTCUT --}}
  <div class="section-title">Akses Cepat</div>
  <div class="shortcut-grid">
    <div class="shortcut">
      <div>
        <b>Tambah UMKM</b>
        <small>Input produk baru</small>
      </div>
      <a class="btn primary" href="{{ route('admin.umkm.create') }}">
        Tambah
      </a>
    </div>

    <div class="shortcut">
      <div>
        <b>Lihat Website Publik</b>
        <small>Halaman utama desa</small>
      </div>
      <a class="btn" href="{{ route('home') }}" target="_blank">
        Buka
      </a>
    </div>
  </div>

</div>

@endsection
