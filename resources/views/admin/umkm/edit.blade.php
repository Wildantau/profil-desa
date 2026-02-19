@extends('admin.layouts.app')

@section('title','Edit UMKM')

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
}

.photo-box img{
  max-width:180px;
  margin-top:12px;
  border-radius:12px;
}

.actions{
  margin-top:26px;
  display:flex;
  gap:16px;
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

  <h1>Edit UMKM</h1>
  <p class="sub">Perbarui data usaha mikro masyarakat desa</p>

  <div class="card">

    <form method="POST"
          action="{{ route('admin.umkm.update', $umkm) }}"
          enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="grid">
        <div>
          <label>Nama Usaha</label>
          <input type="text"
                 name="nama_usaha"
                 value="{{ old('nama_usaha', $umkm->nama_usaha) }}"
                 required>
        </div>

        <div>
          <label>Pelaku Usaha</label>
          <input type="text"
                 name="pelaku"
                 value="{{ old('pelaku', $umkm->pelaku) }}"
                 required>
        </div>

        <div>
          <label>Kategori</label>
          <select name="kategori">
            @foreach(['Pangan','Kerajinan','Jasa','Minuman'] as $kat)
              <option value="{{ $kat }}"
                @selected(old('kategori', $umkm->kategori) === $kat)>
                {{ $kat }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label>Status</label>
          <select name="status">
            <option value="publik" @selected($umkm->status === 'publik')>Publik</option>
            <option value="draft" @selected($umkm->status === 'draft')>Draft</option>
          </select>
        </div>
      </div>

      <div style="margin-top:18px">
        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
      </div>

      <div style="margin-top:18px">
        <label>Foto UMKM</label>

        <label class="photo-box">
          📷 Ganti foto (opsional)
          <input type="file" name="foto" hidden onchange="previewFoto(this)">
          <img id="preview"
               src="{{ $umkm->foto_url }}"
               alt="Foto UMKM">
        </label>
      </div>

      <div class="actions">
        <button class="btn">💾 Simpan Perubahan</button>
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
  }
}
</script>

@endsection
