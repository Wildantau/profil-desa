@extends('admin.layouts.app')

@section('title','Tambah UMKM')

@section('content')

<style>
:root{
  --ink:#0f172a;
  --muted:#64748b;
  --primary:#047857;
  --soft:#ecfdf5;
  --line:rgba(15,23,42,.08);
  --card:#ffffff;
  --shadow:0 18px 40px rgba(2,6,23,.08);
}

.wrap{
  max-width:1100px;
  margin:0 auto;
  padding:32px 24px 80px;
}

h1{
  margin:0;
  font-size:26px;
  font-weight:900;
}

p.sub{
  color:var(--muted);
  margin:6px 0 24px;
}

.card{
  background:var(--card);
  border:1px solid var(--line);
  border-radius:20px;
  box-shadow:var(--shadow);
  padding:26px;
}

.grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:18px;
}

label{
  font-size:13px;
  font-weight:700;
  color:var(--ink);
  margin-bottom:6px;
  display:block;
}

input, select, textarea{
  width:100%;
  padding:12px 14px;
  border-radius:10px;
  border:1px solid #c7d2fe;
  font-size:14px;
}

textarea{
  resize:vertical;
  min-height:100px;
}

.photo-box{
  border:2px dashed #c7d2fe;
  border-radius:14px;
  padding:18px;
  text-align:center;
  cursor:pointer;
  transition:.2s;
}

.photo-box:hover{
  background:#f8fafc;
}

.photo-box img{
  max-width:180px;
  margin-top:12px;
  border-radius:12px;
  display:none;
}

.actions{
  margin-top:26px;
  display:flex;
  gap:16px;
  align-items:center;
}

.btn{
  background:linear-gradient(135deg,#059669,#047857);
  color:#fff;
  padding:12px 20px;
  border-radius:12px;
  font-weight:700;
  border:none;
  cursor:pointer;
}

.cancel{
  color:#dc2626;
  font-weight:700;
  text-decoration:none;
}
</style>

<div class="wrap">

  <h1>Tambah UMKM</h1>
  <p class="sub">Input data usaha mikro masyarakat desa</p>

  <div class="card">

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.umkm.store') }}"
          enctype="multipart/form-data">
      @csrf

      <div class="grid">
        <div>
          <label>Nama Usaha</label>
          <input type="text" name="nama_usaha"
                 value="{{ old('nama_usaha') }}"
                 required>
        </div>

        <div>
          <label>Pelaku Usaha</label>
          <input type="text" name="pelaku"
                 value="{{ old('pelaku') }}"
                 required>
        </div>

        <div>
          <label>Kategori</label>
          <select name="kategori" required>
            <option value="Pangan">Pangan</option>
            <option value="Kerajinan">Kerajinan</option>
            <option value="Jasa">Jasa</option>
            <option value="Minuman">Minuman</option>
          </select>
        </div>

        <div>
          <label>Status</label>
          <select name="status" required>
            <option value="publik">Publik</option>
            <option value="draft">Draft</option>
          </select>
        </div>
      </div>

      <div style="margin-top:18px">
        <label>Deskripsi</label>
        <textarea name="deskripsi"
                  placeholder="Deskripsi singkat UMKM">{{ old('deskripsi') }}</textarea>
      </div>

      {{-- FOTO UMKM --}}
      <div style="margin-top:18px">
        <label>Foto UMKM</label>

        <label class="photo-box">
          📷 Klik untuk upload foto UMKM
          <input type="file" name="foto" accept="image/*" hidden onchange="previewFoto(this)">
          <img id="preview">
        </label>
      </div>

      <div class="actions">
        <button class="btn">💾 Simpan UMKM</button>
        <a href="{{ route('admin.umkm.index') }}" class="cancel">Batal</a>
      </div>

    </form>
  </div>
</div>

<script>
function previewFoto(input){
  const img = document.getElementById('preview');
  const file = input.files[0];
  if(file){
    img.src = URL.createObjectURL(file);
    img.style.display = 'block';
  }
}
</script>

@endsection
