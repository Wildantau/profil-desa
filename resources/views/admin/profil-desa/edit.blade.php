{{-- resources/views/admin/profil-desa/edit.blade.php --}}
@extends('admin.layouts.app')
@section('title','Admin • Profil Desa')

@section('content')

<style>
:root{
  --ink:#0f172a;
  --muted:#64748b;
  --line:rgba(15,23,42,.10);
  --card:#ffffff;
  --shadow:0 10px 30px rgba(0,0,0,.05);
}
.container-max{max-width:1200px;margin:auto;padding:20px;}
.hero{
  background:var(--card);
  border-radius:20px;
  padding:20px;
  box-shadow:var(--shadow);
  margin-bottom:20px;
}
.hero h1{margin:0;font-size:26px;font-weight:800;color:var(--ink);}
.hero p{margin-top:6px;color:var(--muted);}
.panel{
  background:var(--card);
  border-radius:20px;
  box-shadow:var(--shadow);
  padding:20px;
}
label{
  font-weight:700;
  font-size:13px;
  display:block;
  margin-bottom:6px;
}
.input,.textarea{
  width:100%;
  padding:10px 12px;
  border-radius:10px;
  border:1px solid #ddd;
}
.textarea{min-height:100px;}
.row{display:grid;gap:14px;}
.row.two{grid-template-columns:1fr 1fr;}
.sep{margin:25px 0;border:none;height:1px;background:#eee;}
.btn{
  padding:10px 14px;
  border-radius:10px;
  font-weight:700;
  border:none;
  cursor:pointer;
}
.btn.primary{background:#0f766e;color:white;}
.check{display:flex;gap:8px;margin-top:10px;}
.file-link{
  margin-top:8px;
  font-size:13px;
}
.file-link a{
  font-weight:700;
  color:#0f766e;
}
.section-title{
  font-weight:800;
  font-size:18px;
  margin-bottom:14px;
}
</style>

<div class="container-max">

<div class="hero">
  <h1>Admin • Profil Desa</h1>
  <p>Kelola data profil desa serta dokumen resmi RPJMDes & RKPDesa.</p>

  @if(session('success'))
    <div style="color:green;font-weight:700;margin-top:10px;">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div style="color:red;font-weight:700;margin-top:10px;">
      @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif
</div>

<div class="panel">

<form method="POST"
      action="{{ route('admin.profil-desa.update') }}"
      enctype="multipart/form-data">

@csrf
@method('PUT')

{{-- ================= DATA UMUM ================= --}}
<div class="section-title">Data Umum Desa</div>

<div class="row two">
  <div>
    <label>Nama Desa</label>
    <input type="text" name="nama_desa"
           value="{{ old('nama_desa',$profil->nama_desa ?? '') }}"
           class="input" required>
  </div>

  <div>
    <label>Alamat Singkat</label>
    <input type="text" name="alamat_singkat"
           value="{{ old('alamat_singkat',$profil->alamat_singkat ?? '') }}"
           class="input">
  </div>
</div>

<div class="row two">
  <div>
    <label>Kecamatan</label>
    <input type="text" name="kecamatan"
           value="{{ old('kecamatan',$profil->kecamatan ?? '') }}"
           class="input" required>
  </div>

  <div>
    <label>Kabupaten</label>
    <input type="text" name="kabupaten"
           value="{{ old('kabupaten',$profil->kabupaten ?? '') }}"
           class="input" required>
  </div>
</div>

<div class="row two">
  <div>
    <label>Provinsi</label>
    <input type="text" name="provinsi"
           value="{{ old('provinsi',$profil->provinsi ?? '') }}"
           class="input" required>
  </div>

  <div>
    <label>Kode Pos</label>
    <input type="text" name="kode_pos"
           value="{{ old('kode_pos',$profil->kode_pos ?? '') }}"
           class="input">
  </div>
</div>

<div class="row">
  <div>
    <label>Deskripsi Singkat</label>
    <textarea name="deskripsi"
              class="textarea">{{ old('deskripsi',$profil->deskripsi ?? '') }}</textarea>
  </div>
</div>

<hr class="sep">

{{-- ================= RPJMDes ================= --}}
<div class="section-title">Dokumen RPJMDes</div>

<div class="row two">
  <div>
    <label>Upload RPJMDes (PDF)</label>
    <input type="file"
           name="rpjmdes_file"
           class="input"
           accept="application/pdf">

    @if($profil && $profil->rpjmdes_file)
      <div class="file-link">
        File saat ini:
        <a href="{{ asset($profil->rpjmdes_file) }}" target="_blank">
          Lihat RPJMDes
        </a>
      </div>
    @endif
  </div>

  <div class="check">
    <input type="checkbox"
           name="hapus_rpjmdes"
           value="1">
    <div>Hapus RPJMDes</div>
  </div>
</div>

<hr class="sep">

{{-- ================= RKPDes ================= --}}
<div class="section-title">Dokumen Perdes RKPDesa</div>

<div class="row two">
  <div>
    <label>Upload RKPDesa (PDF)</label>
    <input type="file"
           name="rkpdes_file"
           class="input"
           accept="application/pdf">

    @if($profil && $profil->rkpdes_file)
      <div class="file-link">
        File saat ini:
        <a href="{{ asset($profil->rkpdes_file) }}" target="_blank">
          Lihat RKPDesa
        </a>
      </div>
    @endif
  </div>

  <div class="check">
    <input type="checkbox"
           name="hapus_rkpdes"
           value="1">
    <div>Hapus RKPDesa</div>
  </div>
</div>

<hr class="sep">

<div class="check">
  <input type="checkbox"
         name="aktif"
         value="1"
         @checked(old('aktif',$profil->aktif ?? true))>
  <div>Aktifkan Profil Desa</div>
</div>

<div style="margin-top:20px;">
  <button type="submit" class="btn primary">
    Simpan Perubahan
  </button>
</div>

</form>
</div>
</div>

@endsection
