@extends('admin.layouts.app')
@section('title','Edit Perangkat Desa • Admin')

@section('content')

<style>
  :root{
    --ink:#0f172a; --muted:#64748b; --line:rgba(15,23,42,.10);
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

  /* HERO */
  .hero{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    padding:18px;
    backdrop-filter: blur(10px);
    overflow:hidden;
    position:relative;
  }
  .hero::before{
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
  .hero-top{
    display:flex; gap:14px; align-items:flex-start; justify-content:space-between;
    flex-wrap:wrap; position:relative;
  }
  .brand{ display:flex; gap:12px; align-items:center; }
  .mark{
    width:56px; height:56px; border-radius:18px;
    border:1px solid rgba(15,23,42,.12);
    background: linear-gradient(135deg, rgba(34,197,94,.22), rgba(96,165,250,.20), rgba(168,85,247,.16));
    box-shadow: 0 12px 26px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
    flex:0 0 auto;
  }
  .mark svg{ width:26px; height:26px; color: var(--ink); }
  .hero-title{
    margin:0;
    font-size:30px;
    line-height:1.08;
    letter-spacing:-0.03em;
    font-weight:950;
    color:var(--ink);
  }
  @media(max-width:768px){ .hero-title{ font-size:24px; } }
  .hero-sub{
    margin:8px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.8;
    max-width:920px;
    font-weight:800;
  }

  .actions{
    display:flex; gap:10px; flex-wrap:wrap; align-items:center;
    justify-content:flex-end;
  }
  .btn{
    appearance:none; border:none; cursor:pointer;
    padding:10px 12px;
    border-radius:16px;
    font-weight:950;
    font-size:13px;
    color:var(--ink);
    background: rgba(255,255,255,.92);
    border:1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    text-decoration:none;
    display:inline-flex; gap:10px; align-items:center;
    backdrop-filter: blur(10px);
    transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
  }
  .btn:hover{ transform: translateY(-1px); box-shadow: 0 16px 34px rgba(2,6,23,.10); border-color: rgba(16,185,129,.20); }
  .btn svg{ width:18px; height:18px; }
  .btn.primary{
    background: linear-gradient(135deg, rgba(16,185,129,.16), rgba(56,189,248,.12));
    border-color: rgba(16,185,129,.25);
  }
  .btn.danger{
    background: rgba(239,68,68,.10);
    border-color: rgba(239,68,68,.25);
    color:#991b1b;
  }
  .btn.mini{ padding:8px 10px; border-radius:14px; font-size:12px; }

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

  .grid{
    display:grid;
    grid-template-columns: 1fr;
    gap:14px;
  }
  @media(min-width: 980px){
    .grid{ grid-template-columns: 1.1fr .9fr; align-items:start; }
  }

  .field{
    border:1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.94);
    border-radius:18px;
    padding:14px;
    box-shadow: 0 10px 26px rgba(2,6,23,.05);
  }

  .row{ display:grid; gap:12px; }
  @media(min-width:720px){ .row.two{ grid-template-columns:1fr 1fr; } }

  label{
    display:block;
    font-weight:950;
    font-size:13px;
    letter-spacing:.06em;
    text-transform:uppercase;
    margin-bottom:8px;
    color:var(--ink);
  }
  .hint{
    margin-top:6px;
    font-size:12px;
    line-height:1.6;
    color:var(--muted);
    font-weight:800;
  }

  .input, .select{
    width:100%;
    border-radius:14px;
    border:1px solid rgba(15,23,42,.14);
    background: rgba(248,250,252,.95);
    padding:12px;
    font-weight:850;
    color:var(--ink);
    outline:none;
  }
  .input:focus, .select:focus{
    border-color: rgba(16,185,129,.45);
    box-shadow: 0 0 0 4px rgba(16,185,129,.12);
  }
  .input.is-invalid, .select.is-invalid{
    border-color: rgba(239,68,68,.55);
    box-shadow: 0 0 0 4px rgba(239,68,68,.10);
  }
  .err{ margin-top:6px; font-size:12px; color:#b91c1c; font-weight:900; }

  .check{
    display:flex; gap:10px; align-items:flex-start;
    padding:12px;
    border-radius:14px;
    border:1px dashed rgba(15,23,42,.18);
    background: rgba(255,255,255,.75);
  }
  .check input{ margin-top:2px; }
  .check b{ color:var(--ink); }
  .check span{ color:var(--muted); font-size:12px; line-height:1.6; font-weight:800; }

  /* PREVIEW */
  .preview{
    border-radius:22px;
    border:1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.95);
    box-shadow: 0 12px 28px rgba(2,6,23,.06);
    overflow:hidden;
  }
  .pv-head{
    padding:14px 16px;
    border-bottom:1px solid rgba(226,232,240,.9);
    display:flex; justify-content:space-between; align-items:center; gap:10px;
  }
  .pv-head b{ font-weight:950; }
  .pv-head small{ color:var(--muted); font-weight:900; }

  .pv-in{ padding:18px; text-align:center; }
  .pv-avatar{
    width:150px; height:150px;
    margin:0 auto;
    border-radius:32px;
    overflow:hidden;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.95);
    display:flex; align-items:center; justify-content:center;
    box-shadow: 0 10px 22px rgba(2,6,23,.08);
  }
  .pv-avatar img{ width:100%; height:100%; object-fit:cover; object-position:50% 18%; display:block; }
  .fallback{ font-size:54px; opacity:.9; }

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

  .pv-role{
    margin-top:14px;
    padding:8px 14px;
    border-radius:999px;
    background: rgba(16,185,129,.10);
    border:1px solid rgba(16,185,129,.18);
    font-weight:950;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:12px;
    display:inline-flex;
    align-items:center;
    gap:8px;
  }
  .pv-name{
    margin-top:10px;
    font-size:22px;
    font-weight:950;
    color:var(--ink);
  }
  .pv-meta{
    margin-top:12px;
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    justify-content:center;
  }
</style>

@php
  // nilai foto awal (DB) + old()
  $fotoInitial = trim((string) old('foto', $item->foto));

  $fotoUrl = function($path){
    $path = is_string($path) ? trim($path) : '';
    if ($path === '') return null;
    if (preg_match('~^https?://~i', $path)) return $path;
    return asset(ltrim($path, '/'));
  };

  $fotoImg = $fotoUrl($fotoInitial);
@endphp

<div class="adm-wrap">
  <div class="container-max">

    <div class="hero">
      <div class="hero-top">

        <div class="brand">
          <div class="mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 3l8 4v6c0 5-3.5 8-8 8s-8-3-8-8V7l8-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              <path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h1 class="hero-title">Edit Perangkat Desa</h1>
            <p class="hero-sub">
              Perubahan data akan langsung dipakai di halaman publik <b>Pemerintahan</b>.
              Kamu bisa edit teks, status aktif, dan foto (upload atau isi path).
            </p>
          </div>
        </div>

        <div class="actions">
          <a class="btn" href="{{ route('admin.perangkat-desa.index') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
          </a>

          <button class="btn primary" form="formEdit" type="submit">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M19 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h9l7 7v7a2 2 0 0 1-2 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              <path d="M17 21V13H7v8" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            </svg>
            Simpan
          </button>

          <form method="POST" action="{{ route('admin.perangkat-desa.destroy',$item) }}"
                onsubmit="return confirm('Hapus data ini?')">
            @csrf @method('DELETE')
            <button class="btn danger" type="submit">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M3 6h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M8 6V4h8v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M6 6l1 16h10l1-16" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              </svg>
              Hapus
            </button>
          </form>
        </div>

      </div>
    </div>

    <div class="card">
      <div class="pad">
        <div class="grid">

          {{-- FORM --}}
          <form id="formEdit" class="field"
                method="POST"
                action="{{ route('admin.perangkat-desa.update',$item) }}"
                enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row two">
              <div>
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori"
                        class="select @error('kategori') is-invalid @enderror">
                  @foreach($kategoriOptions as $k=>$lbl)
                    <option value="{{ $k }}" @selected(old('kategori',$item->kategori)===(string)$k)>{{ $lbl }}</option>
                  @endforeach
                </select>
                @error('kategori') <div class="err">{{ $message }}</div> @enderror
                <div class="hint">Pilih kelompok perangkat (misal: inti, dusun, RT/RW, dll).</div>
              </div>

              <div>
                <label for="urutan">Urutan</label>
                <input id="urutan" class="input @error('urutan') is-invalid @enderror"
                       type="number" name="urutan"
                       value="{{ old('urutan',$item->urutan) }}"
                       min="0" step="1">
                @error('urutan') <div class="err">{{ $message }}</div> @enderror
                <div class="hint">Semakin kecil, tampil semakin atas di halaman publik.</div>
              </div>
            </div>

            <div class="row">
              <div>
                <label for="jabatan">Jabatan</label>
                <input id="jabatan" class="input @error('jabatan') is-invalid @enderror"
                       name="jabatan"
                       value="{{ old('jabatan',$item->jabatan) }}"
                       maxlength="120"
                       placeholder="Contoh: Kepala Desa / Sekretaris Desa / Kepala Dusun">
                @error('jabatan') <div class="err">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="nama">Nama (boleh kosong)</label>
                <input id="nama" class="input @error('nama') is-invalid @enderror"
                       name="nama"
                       value="{{ old('nama',$item->nama) }}"
                       maxlength="120"
                       placeholder="Isi nama jika sudah siap untuk publik">
                @error('nama') <div class="err">{{ $message }}</div> @enderror
                <div class="hint">Untuk demo profesional, boleh kosong dulu → tampil “_____”.</div>
              </div>

              <div>
                <label for="foto_file">Upload Foto (opsional)</label>
                <input id="foto_file" class="input @error('foto_file') is-invalid @enderror"
                       type="file" name="foto_file" accept="image/*">
                @error('foto_file') <div class="err">{{ $message }}</div> @enderror
                <div class="hint">PNG/JPG/WEBP • maks 2MB.</div>
              </div>

              <div>
                <label for="foto_path">Path Foto / URL (opsional)</label>
                <input id="foto_path" class="input @error('foto_path') is-invalid @enderror"
                       name="foto_path"
                       value="{{ old('foto_path', $fotoInitial) }}"
                       maxlength="255"
                       placeholder="images/pemerintahan/nama.jpg atau https://...">
                @error('foto_path') <div class="err">{{ $message }}</div> @enderror
                <div class="hint">Jika kamu upload foto, controller biasanya akan pakai hasil upload.</div>
              </div>

              {{-- nilai final yang disimpan ke DB --}}
              <input type="hidden" id="foto" name="foto" value="{{ $fotoInitial }}">

              <div class="check">
                <input id="hapus_foto" type="checkbox" name="hapus_foto" value="1"
                       @checked(old('hapus_foto')=='1')>
                <div>
                  <b>Hapus foto saat ini</b><br>
                  <span>Jika dicentang, foto dikosongkan. Upload foto baru akan mengabaikan opsi ini.</span>
                </div>
              </div>

              <div class="check">
                <input id="aktif" type="checkbox" name="aktif" value="1"
                       @checked(old('aktif',$item->aktif))>
                <div>
                  <b>Aktifkan data</b><br>
                  <span>Jika dimatikan, data tidak ditampilkan di halaman publik Pemerintahan.</span>
                </div>
              </div>

              <div class="hint">
                Tips: setelah simpan, cek halaman publik → <b>Pemerintahan</b> untuk memastikan urutan & status tampil sesuai.
              </div>
            </div>
          </form>

          {{-- PREVIEW --}}
          <div class="preview" aria-live="polite">
            <div class="pv-head">
              <div>
                <b>Preview Kartu</b><br>
                <small>Realtime mengikuti input form</small>
              </div>
              <div id="pvStatusBadge"></div>
            </div>

            <div class="pv-in">
              <div class="pv-avatar" id="pvAvatar">
                @if($fotoImg)
                  <img src="{{ $fotoImg }}" alt="foto"
                       onerror="this.remove(); this.parentElement.innerHTML='<span class=&quot;fallback&quot;>👤</span>';"/>
                @else
                  <span class="fallback">👤</span>
                @endif
              </div>

              <div class="pv-role" id="pvRole">
                <span class="dot" id="pvRoleDot" style="background:#22c55e;"></span>
                <span id="pvJabatan">{{ $item->jabatan }}</span>
              </div>

              <div class="pv-name" id="pvName">{{ $item->nama ?: '_____' }}</div>

              <div class="pv-meta">
                <span class="pill" id="pvKategori"><span class="dot"></span> {{ $kategoriOptions[$item->kategori] ?? $item->kategori }}</span>
                <span class="pill" id="pvUrutan"><span class="dot"></span> Urutan: <b style="margin-left:6px;">{{ $item->urutan }}</b></span>
              </div>

              <div class="hint" style="margin-top:12px;">
                Upload foto atau isi path foto untuk melihat preview sebelum simpan.
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
  const el = (id) => document.getElementById(id);

  const kategori   = el('kategori');
  const urutan     = el('urutan');
  const jabatan    = el('jabatan');
  const nama       = el('nama');

  const fotoPath   = el('foto_path');
  const fotoHidden = el('foto');
  const fotoFile   = el('foto_file');
  const hapusFoto  = el('hapus_foto');
  const aktif      = el('aktif');

  const pvAvatar   = el('pvAvatar');
  const pvJabatan  = el('pvJabatan');
  const pvName     = el('pvName');
  const pvKategori = el('pvKategori');
  const pvUrutan   = el('pvUrutan');
  const pvStatus   = el('pvStatusBadge');
  const pvRoleDot  = el('pvRoleDot');

  const pathToUrl = (fp) => {
    if(!fp) return null;
    fp = (fp + '').trim();
    if(fp === '') return null;
    if(/^https?:\/\//i.test(fp)) return fp;
    return '/' + fp.replace(/^\/+/, '');
  };

  const renderAvatar = (srcOrNull) => {
    pvAvatar.innerHTML = '';
    if(!srcOrNull){
      pvAvatar.innerHTML = '<span class="fallback">👤</span>';
      return;
    }
    const img = document.createElement('img');
    img.src = srcOrNull;
    img.alt = 'foto';
    img.onerror = () => { pvAvatar.innerHTML = '<span class="fallback">👤</span>'; };
    pvAvatar.appendChild(img);
  };

  const renderStatus = () => {
    const isOn = !!(aktif && aktif.checked);
    pvStatus.innerHTML = isOn
      ? '<span class="pill ok"><span class="dot"></span>Aktif</span>'
      : '<span class="pill off"><span class="dot"></span>Nonaktif</span>';

    if(pvRoleDot){
      pvRoleDot.style.background = isOn ? '#22c55e' : '#ef4444';
    }
  };

  const updateText = () => {
    pvJabatan.textContent = (jabatan.value || '').trim() || 'Jabatan';
    pvName.textContent = (nama.value || '').trim() || '_____';

    const opt = kategori && kategori.options ? kategori.options[kategori.selectedIndex] : null;
    const catText = opt ? opt.textContent : (kategori.value || 'Kategori');
    pvKategori.innerHTML = '<span class="dot"></span> ' + catText;

    const u = (urutan.value || '').trim();
    pvUrutan.innerHTML = '<span class="dot"></span> Urutan: <b style="margin-left:6px;">' + (u === '' ? '0' : u) + '</b>';
  };

  const syncFotoHiddenAndPreview = () => {
    const hasUpload = !!(fotoFile && fotoFile.files && fotoFile.files.length);

    if(hapusFoto && hapusFoto.checked && !hasUpload){
      fotoHidden.value = '';
      renderAvatar(null);
      return;
    }

    // hidden mengikuti path (kalau tidak hapus)
    fotoHidden.value = (fotoPath.value || '').trim();

    // preview dari path bila tidak upload
    if(!hasUpload){
      renderAvatar(pathToUrl(fotoPath.value || ''));
    }
  };

  const refresh = () => {
    updateText();
    renderStatus();
    syncFotoHiddenAndPreview();
  };

  // listeners text
  ['input','change','keyup'].forEach(evt => {
    [kategori, urutan, jabatan, nama, fotoPath].forEach(x => x && x.addEventListener(evt, refresh));
  });

  // status
  if(aktif) aktif.addEventListener('change', refresh);

  // hapus foto
  if(hapusFoto){
    ['change','input'].forEach(evt => hapusFoto.addEventListener(evt, refresh));
  }

  // upload foto
  if(fotoFile){
    fotoFile.addEventListener('change', function(){
      // upload => otomatis uncheck hapus
      if(hapusFoto && this.files && this.files.length) hapusFoto.checked = false;

      if(this.files && this.files[0]){
        renderAvatar(URL.createObjectURL(this.files[0]));
      }else{
        refresh();
      }
    });
  }

  // init: render awal dari hidden/path, lalu refresh semua
  renderAvatar(pathToUrl((fotoHidden.value || '').trim()));
  refresh();
})();
</script>

@endsection
