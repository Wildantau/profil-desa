@extends('admin.layouts.app')
@section('title','Tambah Perangkat Desa • Admin')

@section('content')
<style>
  :root{
    --ink:#0f172a;
    --muted:#64748b;
    --line:rgba(15,23,42,.10);
    --g1: rgba(96,165,250,.18);
    --g2: rgba(34,197,94,.16);
    --g3: rgba(168,85,247,.14);
    --card: rgba(255,255,255,.92);
    --shadow: 0 18px 45px rgba(2,6,23,.08);
    --shadow2: 0 10px 28px rgba(2,6,23,.06);
    --r16:16px; --r20:20px; --r24:24px;
  }

  .adm-wrap{ width:100%; padding:0 0 18px; }
  .container-max{ max-width:1200px; margin:0 auto; padding:0 2px; }

  /* HERO / TOPBAR */
  .topbar{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    padding:18px;
    backdrop-filter: blur(10px);
    overflow:hidden;
    position:relative;
  }
  .topbar::before{
    content:"";
    position:absolute; inset:-70px -50px auto auto;
    width:290px; height:290px;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.22), transparent 60%),
      radial-gradient(circle at 70% 70%, rgba(96,165,250,.22), transparent 60%),
      radial-gradient(circle at 50% 50%, rgba(168,85,247,.16), transparent 60%);
    filter: blur(2px);
    transform: rotate(18deg);
    pointer-events:none;
  }

  .head{
    display:flex; gap:14px; align-items:flex-start; justify-content:space-between; flex-wrap:wrap;
    position:relative;
  }
  .ttl{
    margin:0;
    font-size:30px;
    line-height:1.08;
    letter-spacing:-0.03em;
    font-weight:950;
    color:var(--ink);
  }
  @media(max-width:768px){ .ttl{ font-size:24px; } }
  .sub{
    margin:8px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.8;
    max-width:900px;
    font-weight:850;
  }

  .actions{ display:flex; gap:10px; flex-wrap:wrap; align-items:center; }

  .btn{
    display:inline-flex; align-items:center; justify-content:center; gap:10px;
    padding:10px 14px;
    border-radius:16px;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(255,255,255,.92);
    color: var(--ink);
    font-weight:950;
    font-size:13px;
    text-decoration:none;
    box-shadow: var(--shadow2);
    transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
    cursor:pointer;
    backdrop-filter: blur(10px);
  }
  .btn:hover{
    transform: translateY(-1px);
    box-shadow: 0 18px 40px rgba(2,6,23,.10);
    border-color: rgba(16,185,129,.28);
  }
  .btn.primary{
    background: linear-gradient(135deg, rgba(16,185,129,.16), rgba(56,189,248,.12));
    border-color: rgba(16,185,129,.25);
  }

  /* CARD */
  .card{
    margin-top:14px;
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .pad{ padding:18px; }
  @media(min-width:768px){ .pad{ padding:24px; } }

  .grid{
    display:grid;
    grid-template-columns: 1fr;
    gap:14px;
  }
  @media(min-width: 980px){
    .grid{ grid-template-columns: 1.1fr .9fr; gap:18px; align-items:start; }
  }

  .field{
    border:1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.94);
    border-radius:18px;
    padding:14px;
    box-shadow: 0 10px 26px rgba(2,6,23,.05);
  }

  .row{ display:grid; grid-template-columns:1fr; gap:12px; }
  @media(min-width: 720px){ .row.two{ grid-template-columns: 1fr 1fr; } }

  label{
    display:block;
    font-weight:950;
    color:var(--ink);
    font-size:13px;
    letter-spacing:.06em;
    text-transform:uppercase;
    margin-bottom:8px;
  }
  .hint{ color:var(--muted); font-size:12px; margin-top:6px; line-height:1.6; font-weight:850; }
  .input, .select{
    width:100%;
    border-radius:14px;
    border:1px solid rgba(15,23,42,.14);
    background: rgba(248,250,252,.95);
    padding:12px 12px;
    outline:none;
    color:var(--ink);
    font-weight:800;
    font-size:14px;
  }
  .input:focus, .select:focus{
    border-color: rgba(16,185,129,.45);
    box-shadow: 0 0 0 4px rgba(16,185,129,.12);
  }

  /* per-field error */
  .ferr{
    margin-top:8px;
    padding:10px 12px;
    border-radius: 14px;
    border:1px solid rgba(239,68,68,.25);
    background: rgba(239,68,68,.08);
    color:#7f1d1d;
    font-weight:900;
    font-size:13px;
    line-height:1.6;
  }

  .check{
    display:flex; gap:10px; align-items:flex-start;
    padding:12px 12px;
    border-radius:14px;
    border:1px dashed rgba(15,23,42,.18);
    background: rgba(255,255,255,.80);
  }
  .check input{ margin-top:2px; }
  .check b{ color:var(--ink); font-weight:950; }
  .check span{ color:var(--muted); font-size:12px; line-height:1.6; font-weight:850; }

  /* PREVIEW */
  .preview{
    border-radius:22px;
    border:1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.95);
    box-shadow: 0 12px 28px rgba(2,6,23,.06);
    overflow:hidden;
    position:relative;
  }
  .preview::before{
    content:"";
    position:absolute; inset:0;
    background:
      radial-gradient(520px 220px at 12% 0%, rgba(96,165,250,.11), transparent 62%),
      radial-gradient(520px 220px at 88% 0%, rgba(34,197,94,.11), transparent 62%);
    opacity:.95;
    pointer-events:none;
  }
  .p-in{ position:relative; padding:18px; text-align:center; }
  .p-avatar{
    width:150px; height:150px;
    margin:0 auto;
    border-radius:32px;
    overflow:hidden;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.94);
    box-shadow: 0 12px 26px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
  }
  .p-avatar img{ width:100%; height:100%; object-fit:cover; object-position:50% 18%; display:block; }
  .fallback{ font-size:54px; opacity:.92; }

  .pill{
    display:inline-flex; align-items:center; gap:8px;
    padding:6px 10px;
    border-radius:999px;
    font-weight:950;
    font-size:12px;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.92);
    color:#0f172a;
    white-space:nowrap;
  }
  .dot{ width:8px; height:8px; border-radius:999px; background:#94a3b8; }
  .pill.ok{ border-color: rgba(34,197,94,.25); background: rgba(34,197,94,.10); color:#065f46; }
  .pill.ok .dot{ background:#22c55e; }
  .pill.off{ border-color: rgba(239,68,68,.22); background: rgba(239,68,68,.08); color:#991b1b; }
  .pill.off .dot{ background:#ef4444; }

  .p-badges{
    margin-top:12px;
    display:flex; gap:8px; justify-content:center; flex-wrap:wrap;
  }

  .p-role{
    margin-top:14px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:8px 14px;
    border-radius:999px;
    border:1px solid rgba(16,185,129,.22);
    background: rgba(16,185,129,.10);
    color:#065f46;
    font-weight:950;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:12px;
    white-space:nowrap;
    max-width: 100%;
  }
  .p-name{
    margin-top:10px;
    font-size:22px;
    font-weight:950;
    letter-spacing:-.02em;
    color:var(--ink);
    line-height:1.2;
  }
</style>

@php
  // helper label kategori buat preview (mengambil label dari opsi yang sudah ada)
  $katLabel = function($key) use ($kategoriOptions){
    return $kategoriOptions[$key] ?? (string)$key;
  };
@endphp

<div class="adm-wrap">
  <div class="container-max">

    <div class="topbar">
      <div class="head">
        <div>
          <h1 class="ttl">Tambah Perangkat Desa</h1>
          <p class="sub">
            Form ini mengisi tabel <b>perangkat_desa</b> (SQLite). Data akan tampil otomatis di halaman <b>Pemerintahan</b>.
          </p>
        </div>

        <div class="actions">
          <a class="btn" href="{{ route('admin.perangkat-desa.index') }}">← Kembali</a>
          <button class="btn primary" form="formCreate" type="submit">💾 Simpan</button>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="pad">
        <div class="grid">

          {{-- FORM --}}
          <form id="formCreate"
                class="field"
                method="POST"
                action="{{ route('admin.perangkat-desa.store') }}"
                enctype="multipart/form-data">
            @csrf

            <div class="row two">
              <div>
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" class="select" required>
                  @foreach($kategoriOptions as $val => $label)
                    <option value="{{ $val }}" @selected(old('kategori', array_key_first($kategoriOptions)) === $val)>{{ $label }}</option>
                  @endforeach
                </select>
                <div class="hint">Pilih jenis perangkat (Kepala Desa, Kaur, Kasi, Dusun, dll).</div>
                @error('kategori') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="urutan">Urutan</label>
                <input id="urutan" type="number" name="urutan" class="input"
                       value="{{ old('urutan', $defaultUrutan ?? 10) }}" min="0" max="9999" required>
                <div class="hint">Semakin kecil, tampil lebih atas. Rekomendasi beda 10 (10,20,30).</div>
                @error('urutan') <div class="ferr">{{ $message }}</div> @enderror
              </div>
            </div>

            <div style="height:12px"></div>

            <div class="row">
              <div>
                <label for="jabatan">Jabatan</label>
                <input id="jabatan" type="text" name="jabatan" class="input"
                       value="{{ old('jabatan') }}" maxlength="120" placeholder="Contoh: Kepala Desa" required>
                @error('jabatan') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="nama">Nama (boleh kosong)</label>
                <input id="nama" type="text" name="nama" class="input"
                       value="{{ old('nama') }}" maxlength="120" placeholder="_____">
                <div class="hint">Kalau kosong, tampil sebagai <b>“_____”</b> (aman untuk demo profesional).</div>
                @error('nama') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="foto_file">Upload Foto (opsional)</label>
                <input id="foto_file" type="file" name="foto_file" class="input" accept="image/*">
                <div class="hint">JPG / PNG / WEBP • Maks 2MB • Jika upload, sistem pakai hasil upload.</div>
                @error('foto_file') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="foto">Path Foto / URL (opsional)</label>
                <input id="foto" type="text" name="foto" class="input"
                       value="{{ old('foto') }}" maxlength="255"
                       placeholder="images/pemerintahan/nama-file.png atau https://...">
                <div class="hint">
                  Bisa path relatif di folder <b>public/</b> atau URL. Jika upload file, field ini akan diabaikan (sesuai controller kamu).
                </div>
                @error('foto') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div class="check">
                <input id="aktif" type="checkbox" name="aktif" value="1" @checked(old('aktif', true))>
                <div>
                  <b>Aktifkan data</b><br>
                  <span>Jika dimatikan, data tidak akan tampil di halaman Pemerintahan.</span>
                </div>
              </div>
              @error('aktif') <div class="ferr">{{ $message }}</div> @enderror
            </div>
          </form>

          {{-- PREVIEW --}}
          <div class="preview" aria-live="polite">
            <div class="p-in">
              <div class="p-avatar" id="pImgWrap" aria-hidden="true">
                <span class="fallback">👤</span>
              </div>

              <div class="p-badges">
                <span class="pill" id="pKat"><span class="dot"></span>Kategori</span>
                <span class="pill ok" id="pAktif"><span class="dot"></span>Aktif</span>
              </div>

              <div class="p-role" id="pRoleText">JABATAN</div>
              <div class="p-name" id="pNameText">_____</div>

              <div class="hint" style="margin-top:10px;">
                Preview mengikuti input form. Upload foto akan tampil sebelum disimpan.
              </div>

              <div class="hint" style="margin-top:10px;">
                Tips: kalau pakai path, pastikan file ada di <b>public/images/pemerintahan/</b>.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<script>
(function(){
  const kategori  = document.getElementById('kategori');
  const jabatan   = document.getElementById('jabatan');
  const nama      = document.getElementById('nama');
  const fotoPath  = document.getElementById('foto');
  const fotoFile  = document.getElementById('foto_file');
  const aktif     = document.getElementById('aktif');

  const pRole = document.getElementById('pRoleText');
  const pName = document.getElementById('pNameText');
  const pWrap = document.getElementById('pImgWrap');
  const pKat  = document.getElementById('pKat');
  const pAkt  = document.getElementById('pAktif');

  const pathToUrl = (fp) => {
    if(!fp) return null;
    fp = (fp + '').trim();
    if(fp === '') return null;
    if(/^https?:\/\//i.test(fp)) return fp;
    return '/' + fp.replace(/^\/+/, '');
  };

  const renderAvatar = (srcOrNull) => {
    pWrap.innerHTML = '';
    if(!srcOrNull){
      pWrap.innerHTML = '<span class="fallback">👤</span>';
      return;
    }
    const img = document.createElement('img');
    img.src = srcOrNull;
    img.alt = 'Preview';
    img.onerror = () => { pWrap.innerHTML = '<span class="fallback">👤</span>'; };
    pWrap.appendChild(img);
  };

  const setPreview = () => {
    const role = (jabatan.value || '').trim();
    const nm   = (nama.value || '').trim();

    pRole.textContent = (role !== '' ? role : 'JABATAN').toUpperCase();
    pName.textContent = nm !== '' ? nm : '_____';

    // badge kategori pakai label option (yang tampil)
    if(kategori && kategori.selectedOptions && kategori.selectedOptions[0]){
      const txt = kategori.selectedOptions[0].textContent.trim();
      pKat.innerHTML = '<span class="dot"></span>' + (txt || 'Kategori');
    }

    // status aktif/nonaktif
    const isAktif = aktif ? !!aktif.checked : true;
    if(isAktif){
      pAkt.className = 'pill ok';
      pAkt.innerHTML = '<span class="dot"></span>Aktif';
    }else{
      pAkt.className = 'pill off';
      pAkt.innerHTML = '<span class="dot"></span>Nonaktif';
    }

    // kalau tidak upload, ambil dari path/url
    if(!fotoFile.files || !fotoFile.files.length){
      renderAvatar(pathToUrl(fotoPath.value || ''));
    }
  };

  ['input','change','keyup'].forEach(evt=>{
    if(kategori) kategori.addEventListener(evt, setPreview);
    if(jabatan) jabatan.addEventListener(evt, setPreview);
    if(nama) nama.addEventListener(evt, setPreview);
    if(fotoPath) fotoPath.addEventListener(evt, setPreview);
    if(aktif) aktif.addEventListener(evt, setPreview);
  });

  if(fotoFile){
    fotoFile.addEventListener('change', function(){
      if(this.files && this.files[0]){
        renderAvatar(URL.createObjectURL(this.files[0]));
      }else{
        setPreview();
      }
    });
  }

  setPreview();
})();
</script>
@endsection
