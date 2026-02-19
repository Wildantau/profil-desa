@extends('admin.layouts.app')

@section('title', 'Tambah Wisata Desa')

@section('content')

<style>
/* ===============================
   FORM WISATA - FINAL PROFESSIONAL
   =============================== */
.form-wisata{
  max-width:980px;
  background:#ffffff;
  padding:36px;
  border-radius:20px;
  box-shadow:0 20px 50px rgba(2,6,23,.08);
}

.form-wisata h1{
  font-size:26px;
  font-weight:900;
  color:#0f172a;
}

.form-wisata .desc{
  margin-top:6px;
  font-size:14px;
  color:#64748b;
  max-width:720px;
}

.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px;
  margin-top:28px;
}

.form-group{
  display:flex;
  flex-direction:column;
}

.form-group.full{
  grid-column:1 / -1;
}

label{
  font-weight:800;
  font-size:13px;
  margin-bottom:6px;
  color:#0f172a;
}

input,
textarea,
select{
  padding:12px 14px;
  border-radius:14px;
  border:1px solid rgba(15,23,42,.15);
  font-size:14px;
  outline:none;
}

input:focus,
textarea:focus,
select:focus{
  border-color:#2563eb;
}

textarea{
  resize:vertical;
}

small{
  font-size:12px;
  color:#64748b;
  margin-top:4px;
}

/* Preview Foto */
.preview{
  margin-top:10px;
}
.preview img{
  max-width:100%;
  border-radius:14px;
  border:1px solid rgba(15,23,42,.15);
}

/* Actions */
.form-actions{
  margin-top:32px;
  display:flex;
  gap:12px;
}

.btn{
  padding:10px 20px;
  border-radius:999px;
  font-size:13px;
  font-weight:800;
  text-decoration:none;
  border:1px solid rgba(15,23,42,.15);
  background:#fff;
  cursor:pointer;
}

.btn.primary{
  background:#2563eb;
  border-color:#2563eb;
  color:#fff;
}

.btn.secondary{
  background:#f1f5f9;
}
</style>

<div class="form-wisata">

  <h1>Tambah Wisata Desa</h1>
  <p class="desc">
    Form ini digunakan untuk menambahkan data destinasi wisata desa.
    Data dengan status <b>Publik</b> akan ditampilkan pada halaman website desa.
  </p>

  {{-- ERROR VALIDASI --}}
  @if ($errors->any())
    <div style="margin-top:20px; color:#dc2626; font-size:13px;">
      <b>Terjadi kesalahan:</b>
      <ul style="margin-left:18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST"
        action="{{ route('admin.wisata.store') }}"
        enctype="multipart/form-data">
    @csrf

    <div class="form-grid">

      {{-- NAMA --}}
      <div class="form-group">
        <label>Nama Destinasi Wisata</label>
        <input type="text"
               name="nama"
               value="{{ old('nama') }}"
               required>
      </div>

      {{-- LOKASI --}}
      <div class="form-group">
        <label>Lokasi / Alamat</label>
        <input type="text"
               name="lokasi"
               value="{{ old('lokasi') }}">
      </div>

      {{-- DESKRIPSI --}}
      <div class="form-group full">
        <label>Deskripsi Singkat</label>
        <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
        <small>Deskripsi singkat mengenai daya tarik wisata.</small>
      </div>

      {{-- FOTO --}}
      <div class="form-group">
        <label>Foto Destinasi</label>
        <input type="file"
               name="foto"
               accept="image/*"
               onchange="previewImage(event)">
        <small>Format JPG / PNG / WEBP (maks. 2MB).</small>
        <div class="preview" id="previewImage"></div>
      </div>

      {{-- STATUS --}}
      <div class="form-group">
        <label>Status Publikasi</label>
        <select name="status" required>
          <option value="">-- Pilih Status --</option>
          <option value="draft" {{ old('status')=='draft'?'selected':'' }}>
            Draft (Belum Ditampilkan)
          </option>
          <option value="publik" {{ old('status')=='publik'?'selected':'' }}>
            Publik (Tampil di Website)
          </option>
        </select>
      </div>

    </div>

    <div class="form-actions">
      <button type="submit" class="btn primary">
        Simpan Data
      </button>
      <a href="{{ route('admin.wisata.index') }}" class="btn secondary">
        Batal
      </a>
    </div>

  </form>
</div>

<script>
function previewImage(event){
  const output = document.getElementById('previewImage');
  output.innerHTML = '';
  if(event.target.files.length === 0) return;

  const img = document.createElement('img');
  img.src = URL.createObjectURL(event.target.files[0]);
  output.appendChild(img);
}
</script>

@endsection
