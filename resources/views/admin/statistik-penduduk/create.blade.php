@extends('admin.layouts.app')

@section('title','Tambah Statistik Penduduk')

@section('content')

<style>
/* =====================================================
   SMART VILLAGE — ADMIN FORM (FINAL)
===================================================== */
:root{
  --ink:#0f172a;
  --muted:#64748b;
  --line:rgba(15,23,42,.10);
  --primary:#2563eb;
  --primary-soft:rgba(37,99,235,.12);
  --soft:#f8fafc;
  --card:#ffffff;
  --shadow:0 20px 55px rgba(2,6,23,.12);
}

/* ================= WRAPPER ================= */
.form-wrap{
  max-width:1200px;
  margin:40px auto;
  background:var(--card);
  padding:44px;
  border-radius:26px;
  box-shadow:var(--shadow);
}

/* ================= HEADER ================= */
.form-head{
  margin-bottom:36px;
}
.form-head h2{
  font-size:30px;
  font-weight:900;
  margin-bottom:8px;
  color:var(--ink);
}
.form-head p{
  font-size:14px;
  color:var(--muted);
  max-width:960px;
  line-height:1.7;
}

/* ================= SECTION ================= */
.section{
  margin-top:42px;
  padding:30px;
  border-radius:22px;
  background:var(--soft);
  border:1px solid var(--line);
  position:relative;
}
.section::before{
  content:"";
  position:absolute;
  top:0;
  left:0;
  width:6px;
  height:100%;
  border-radius:22px 0 0 22px;
  background:linear-gradient(180deg,var(--primary),#38bdf8);
}
.section h3{
  font-size:19px;
  font-weight:900;
  margin-bottom:6px;
  color:var(--ink);
}
.section small{
  display:block;
  font-size:13px;
  color:var(--muted);
  margin-bottom:22px;
}

/* ================= GRID ================= */
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
.form-group.full{
  grid-column:1 / -1;
}

label{
  font-size:13px;
  font-weight:800;
  margin-bottom:6px;
  color:#334155;
}

input, select, textarea{
  padding:12px 14px;
  border-radius:12px;
  border:1px solid #cbd5f5;
  font-size:14px;
  background:#fff;
}

input:focus, select:focus, textarea:focus{
  outline:none;
  border-color:var(--primary);
  box-shadow:0 0 0 4px var(--primary-soft);
}

/* ================= ACTION ================= */
.actions{
  margin-top:46px;
  display:flex;
  gap:14px;
  flex-wrap:wrap;
}

.btn-primary{
  background:var(--primary);
  color:#fff;
  border:none;
  padding:15px 34px;
  border-radius:14px;
  font-weight:900;
  font-size:14px;
  cursor:pointer;
}

.btn-secondary{
  background:#e5e7eb;
  color:#0f172a;
  padding:15px 34px;
  border-radius:14px;
  font-weight:800;
  text-decoration:none;
}

/* ================= INFO NOTE ================= */
.note{
  margin-top:26px;
  font-size:12px;
  color:#64748b;
  background:#f1f5f9;
  padding:14px 18px;
  border-radius:12px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:900px){
  .grid{ grid-template-columns:1fr 1fr; }
}
@media(max-width:600px){
  .grid, .grid.two, .grid.three{
    grid-template-columns:1fr;
  }
}
</style>

<div class="form-wrap">

  {{-- ================= HEADER ================= --}}
  <div class="form-head">
    <h2>Tambah Statistik Penduduk</h2>
    <p>
      Form resmi <strong>Smart Village Desa Suriamedal</strong> untuk
      input statistik kependudukan bulanan.  
      Data ini bersifat <b>agregat</b>, tidak menyimpan data pribadi warga,
      dan akan ditampilkan ke publik dalam bentuk grafik & ringkasan visual.
    </p>
  </div>

  <form method="POST" action="{{ route('admin.statistik-penduduk.store') }}">
    @csrf

    {{-- ================= PERIODE ================= --}}
    <div class="section">
      <h3>📅 Periode Laporan</h3>
      <small>Bulan dan tahun laporan statistik</small>

      <div class="grid two">
        <div class="form-group">
          <label>Tahun</label>
          <input type="number" name="tahun" value="{{ date('Y') }}" required>
        </div>
        <div class="form-group">
          <label>Bulan</label>
          <select name="bulan" required>
            <option value="">Pilih Bulan</option>
            @foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $k=>$v)
              <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    {{-- ================= DATA INTI ================= --}}
    <div class="section">
      <h3>👥 Jumlah Penduduk</h3>
      <small>Berdasarkan jenis kelamin</small>

      <div class="grid three">
        <div class="form-group">
          <label>Laki-laki</label>
          <input type="number" name="laki_laki" min="0" value="0">
        </div>
        <div class="form-group">
          <label>Perempuan</label>
          <input type="number" name="perempuan" min="0" value="0">
        </div>
        <div class="form-group">
          <label>Total (Otomatis)</label>
          <input type="number" name="total" readonly>
        </div>
      </div>
    </div>

    {{-- ================= USIA ================= --}}
    <div class="section">
      <h3>🎂 Komposisi Usia</h3>
      <small>Distribusi kelompok umur penduduk</small>

      <div class="grid three">
        <div class="form-group">
          <label>0–14 Tahun</label>
          <input type="number" name="usia[0_14]" min="0">
        </div>
        <div class="form-group">
          <label>15–64 Tahun</label>
          <input type="number" name="usia[15_64]" min="0">
        </div>
        <div class="form-group">
          <label>65 Tahun ke Atas</label>
          <input type="number" name="usia[65_plus]" min="0">
        </div>
      </div>
    </div>

    {{-- ================= PEKERJAAN ================= --}}
    <div class="section">
      <h3>💼 Pekerjaan</h3>
      <small>Mata pencaharian utama penduduk</small>

      <div class="grid">
        <div class="form-group"><label>Petani</label><input type="number" name="pekerjaan[petani]" min="0"></div>
        <div class="form-group"><label>Buruh</label><input type="number" name="pekerjaan[buruh]" min="0"></div>
        <div class="form-group"><label>UMKM</label><input type="number" name="pekerjaan[umkm]" min="0"></div>
        <div class="form-group"><label>PNS</label><input type="number" name="pekerjaan[pns]" min="0"></div>
      </div>
    </div>

    {{-- ================= PENDIDIKAN ================= --}}
    <div class="section">
      <h3>🎓 Pendidikan</h3>
      <small>Pendidikan terakhir penduduk</small>

      <div class="grid">
        <div class="form-group"><label>Tidak Sekolah</label><input type="number" name="pendidikan[tidak_sekolah]" min="0"></div>
        <div class="form-group"><label>SD</label><input type="number" name="pendidikan[sd]" min="0"></div>
        <div class="form-group"><label>SMP</label><input type="number" name="pendidikan[smp]" min="0"></div>
        <div class="form-group"><label>SMA/SMK</label><input type="number" name="pendidikan[sma]" min="0"></div>
      </div>
    </div>

    {{-- ================= AGAMA ================= --}}
    <div class="section">
      <h3>🕌 Agama</h3>
      <small>Distribusi agama penduduk</small>

      <div class="grid">
        <div class="form-group"><label>Islam</label><input type="number" name="agama[islam]" min="0"></div>
        <div class="form-group"><label>Kristen</label><input type="number" name="agama[kristen]" min="0"></div>
        <div class="form-group"><label>Katolik</label><input type="number" name="agama[katolik]" min="0"></div>
        <div class="form-group"><label>Lainnya</label><input type="number" name="agama[lainnya]" min="0"></div>
      </div>
    </div>

    {{-- ================= ACTION ================= --}}
    <div class="actions">
      <button class="btn-primary">💾 Simpan Statistik</button>
      <a href="{{ route('admin.statistik-penduduk.index') }}" class="btn-secondary">
        ← Kembali
      </a>
    </div>

    <div class="note">
      ℹ️ Data yang disimpan akan langsung digunakan untuk grafik publik
      <b>Smart Village</b> dan dashboard admin.
    </div>

  </form>
</div>

<script>
/* AUTO HITUNG TOTAL */
const laki = document.querySelector('[name="laki_laki"]');
const perempuan = document.querySelector('[name="perempuan"]');
const total = document.querySelector('[name="total"]');

function hitungTotal(){
  total.value = (parseInt(laki.value||0) + parseInt(perempuan.value||0));
}
laki.addEventListener('input', hitungTotal);
perempuan.addEventListener('input', hitungTotal);
</script>

@endsection
