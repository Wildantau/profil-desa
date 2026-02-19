@extends('admin.layouts.app')

@section('title','Edit Statistik Penduduk')

@section('content')

<style>
/* =====================================================
   SMART VILLAGE — ADMIN EDIT FORM
===================================================== */
:root{
  --ink:#0f172a;
  --muted:#64748b;
  --line:rgba(15,23,42,.10);
  --primary:#2563eb;
  --danger:#dc2626;
  --soft:#f8fafc;
  --card:#ffffff;
  --shadow:0 18px 45px rgba(2,6,23,.10);
}

.form-wrap{
  max-width:1200px;
  margin:auto;
  background:var(--card);
  padding:40px;
  border-radius:24px;
  box-shadow:var(--shadow);
}

.form-head h2{
  font-size:28px;
  font-weight:900;
  margin-bottom:6px;
}
.form-head p{
  font-size:14px;
  color:var(--muted);
  max-width:900px;
}

.section{
  margin-top:40px;
  padding:28px;
  border-radius:20px;
  background:var(--soft);
  border:1px solid var(--line);
}
.section h3{
  font-size:18px;
  font-weight:800;
  margin-bottom:6px;
}
.section small{
  display:block;
  font-size:13px;
  color:var(--muted);
  margin-bottom:20px;
}

.grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
}
.grid.two{ grid-template-columns:repeat(2,1fr); }
.grid.three{ grid-template-columns:repeat(3,1fr); }

.form-group{
  display:flex;
  flex-direction:column;
}
label{
  font-size:13px;
  font-weight:700;
  margin-bottom:6px;
  color:#334155;
}
input, select, textarea{
  padding:12px 14px;
  border-radius:10px;
  border:1px solid #cbd5f5;
  font-size:14px;
}
input:focus, select:focus, textarea:focus{
  outline:none;
  border-color:var(--primary);
  box-shadow:0 0 0 3px rgba(37,99,235,.15);
}

.actions{
  margin-top:42px;
  display:flex;
  gap:14px;
  flex-wrap:wrap;
}
.btn-primary{
  background:var(--primary);
  color:#fff;
  border:none;
  padding:14px 30px;
  border-radius:12px;
  font-weight:900;
}
.btn-secondary{
  background:#e5e7eb;
  color:#0f172a;
  padding:14px 30px;
  border-radius:12px;
  font-weight:800;
  text-decoration:none;
}
.btn-danger{
  background:var(--danger);
  color:#fff;
  padding:14px 30px;
  border-radius:12px;
  font-weight:900;
  border:none;
}

@media(max-width:900px){
  .grid{ grid-template-columns:1fr 1fr; }
}
@media(max-width:600px){
  .grid, .grid.two, .grid.three{ grid-template-columns:1fr; }
}
</style>

<div class="form-wrap">

  {{-- HEADER --}}
  <div class="form-head">
    <h2>Edit Statistik Penduduk</h2>
    <p>
      Perubahan data akan langsung memengaruhi tampilan publik
      <strong>Statistik Kependudukan Desa Suriamedal</strong>.
      Tidak ada data individu yang disimpan.
    </p>
  </div>

  <form method="POST" action="{{ route('admin.statistik-penduduk.update', $row->id) }}">
    @csrf
    @method('PUT')

    {{-- ================= PERIODE (READ ONLY) ================= --}}
    <div class="section">
      <h3>Periode Laporan</h3>
      <small>Tahun & bulan tidak dapat diubah</small>

      <div class="grid two">
        <div class="form-group">
          <label>Tahun</label>
          <input type="number" value="{{ $row->tahun }}" readonly>
        </div>
        <div class="form-group">
          <label>Bulan</label>
          <input type="number" value="{{ $row->bulan }}" readonly>
        </div>
      </div>
    </div>

    {{-- ================= DATA INTI ================= --}}
    <div class="section">
      <h3>Jumlah Penduduk</h3>

      <div class="grid three">
        <div class="form-group">
          <label>Laki-laki</label>
          <input type="number" name="laki_laki" value="{{ $row->laki_laki }}">
        </div>
        <div class="form-group">
          <label>Perempuan</label>
          <input type="number" name="perempuan" value="{{ $row->perempuan }}">
        </div>
        <div class="form-group">
          <label>Total (Otomatis)</label>
          <input type="number" name="total" value="{{ $row->total }}" readonly>
        </div>
      </div>
    </div>

    {{-- ================= USIA ================= --}}
    <div class="section">
      <h3>Komposisi Usia</h3>

      <div class="grid">
        <div class="form-group">
          <label>0–14 Tahun</label>
          <input type="number" name="usia[0-14]" value="{{ $row->usia['0-14'] ?? 0 }}">
        </div>
        <div class="form-group">
          <label>15–64 Tahun</label>
          <input type="number" name="usia[15-64]" value="{{ $row->usia['15-64'] ?? 0 }}">
        </div>
        <div class="form-group">
          <label>65+ Tahun</label>
          <input type="number" name="usia[65+]" value="{{ $row->usia['65+'] ?? 0 }}">
        </div>
      </div>
    </div>

    {{-- ================= PEKERJAAN ================= --}}
    <div class="section">
      <h3>Pekerjaan</h3>

      <div class="grid">
        <div class="form-group"><label>Petani</label><input type="number" name="pekerjaan[Petani]" value="{{ $row->pekerjaan['Petani'] ?? 0 }}"></div>
        <div class="form-group"><label>Buruh</label><input type="number" name="pekerjaan[Buruh]" value="{{ $row->pekerjaan['Buruh'] ?? 0 }}"></div>
        <div class="form-group"><label>UMKM</label><input type="number" name="pekerjaan[UMKM]" value="{{ $row->pekerjaan['UMKM'] ?? 0 }}"></div>
        <div class="form-group"><label>PNS</label><input type="number" name="pekerjaan[PNS]" value="{{ $row->pekerjaan['PNS'] ?? 0 }}"></div>
      </div>
    </div>

    {{-- ================= PENDIDIKAN ================= --}}
    <div class="section">
      <h3>Pendidikan</h3>

      <div class="grid">
        <div class="form-group"><label>Tidak Sekolah</label><input type="number" name="pendidikan[Tidak Sekolah]" value="{{ $row->pendidikan['Tidak Sekolah'] ?? 0 }}"></div>
        <div class="form-group"><label>SD</label><input type="number" name="pendidikan[SD]" value="{{ $row->pendidikan['SD'] ?? 0 }}"></div>
        <div class="form-group"><label>SMP</label><input type="number" name="pendidikan[SMP]" value="{{ $row->pendidikan['SMP'] ?? 0 }}"></div>
        <div class="form-group"><label>SMA/SMK</label><input type="number" name="pendidikan[SMA/SMK]" value="{{ $row->pendidikan['SMA/SMK'] ?? 0 }}"></div>
      </div>
    </div>

    {{-- ================= AGAMA ================= --}}
    <div class="section">
      <h3>Agama</h3>

      <div class="grid">
        <div class="form-group"><label>Islam</label><input type="number" name="agama[Islam]" value="{{ $row->agama['Islam'] ?? 0 }}"></div>
        <div class="form-group"><label>Kristen</label><input type="number" name="agama[Kristen]" value="{{ $row->agama['Kristen'] ?? 0 }}"></div>
        <div class="form-group"><label>Katolik</label><input type="number" name="agama[Katolik]" value="{{ $row->agama['Katolik'] ?? 0 }}"></div>
        <div class="form-group"><label>Lainnya</label><input type="number" name="agama[Lainnya]" value="{{ $row->agama['Lainnya'] ?? 0 }}"></div>
      </div>
    </div>

    {{-- ================= ACTION ================= --}}
    <div class="actions">
      <button class="btn-primary">💾 Simpan Perubahan</button>
      <a href="{{ route('admin.statistik-penduduk.index') }}" class="btn-secondary">← Kembali</a>
    </div>

  </form>

  {{-- HAPUS --}}
  <form method="POST" action="{{ route('admin.statistik-penduduk.destroy', $row->id) }}"
        onsubmit="return confirm('Hapus data statistik ini?')">
    @csrf
    @method('DELETE')
    <button class="btn-danger" style="margin-top:20px">🗑 Hapus Data</button>
  </form>

</div>

<script>
const l = document.querySelector('[name="laki_laki"]');
const p = document.querySelector('[name="perempuan"]');
const t = document.querySelector('[name="total"]');

function hitung(){
  t.value = (parseInt(l.value||0) + parseInt(p.value||0));
}
l.addEventListener('input', hitung);
p.addEventListener('input', hitung);
</script>

@endsection
