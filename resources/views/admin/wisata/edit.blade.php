@extends('admin.layouts.app')

@section('title', 'Edit Wisata Desa')

@section('content')

<style>
.form-wisata{
  max-width:900px;
  background:#fff;
  padding:28px;
  border-radius:18px;
  box-shadow:0 10px 30px rgba(0,0,0,.08);
}
.form-wisata h1{
  font-size:24px;
  font-weight:900;
  margin-bottom:6px;
}
.form-wisata p{
  font-size:14px;
  color:#475569;
  margin-bottom:24px;
}
.form-wisata label{
  font-weight:800;
  font-size:13px;
  display:block;
  margin-bottom:6px;
}
.form-wisata input,
.form-wisata textarea,
.form-wisata select{
  width:100%;
  padding:12px 14px;
  border-radius:12px;
  border:1px solid rgba(15,23,42,.15);
  font-size:14px;
  margin-bottom:18px;
}
.form-actions{
  display:flex;
  gap:10px;
}
.btn{
  padding:10px 18px;
  border-radius:999px;
  font-size:13px;
  font-weight:800;
  text-decoration:none;
  border:1px solid rgba(15,23,42,.15);
  background:#fff;
}
.btn.primary{
  background:#2563eb;
  color:#fff;
  border-color:#2563eb;
}
</style>

<div class="form-wisata">
  <h1>Edit Wisata Desa</h1>
  <p>Perbarui informasi destinasi wisata desa.</p>

  <form method="POST" action="{{ route('admin.wisata.update', $wisata) }}">
    @csrf
    @method('PUT')

    <label>Nama Destinasi Wisata</label>
    <input type="text" name="nama" value="{{ $wisata->nama }}" required>

    <label>Lokasi / Alamat</label>
    <input type="text" name="lokasi" value="{{ $wisata->lokasi }}">

    <label>Deskripsi Singkat</label>
    <textarea name="deskripsi" rows="4">{{ $wisata->deskripsi }}</textarea>

    <label>Status Publikasi</label>
    <select name="status">
      <option value="draft" {{ $wisata->status=='draft'?'selected':'' }}>Draft</option>
      <option value="publik" {{ $wisata->status=='publik'?'selected':'' }}>Publik</option>
    </select>

    <div class="form-actions">
      <button class="btn primary">Update Data</button>
      <a href="{{ route('admin.wisata.index') }}" class="btn">Batal</a>
    </div>
  </form>
</div>

@endsection
