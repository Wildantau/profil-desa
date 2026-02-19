@extends('admin.layouts.app')
@section('title','Tambah Data Penduduk • Admin')

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
  .hero-top{ display:flex; gap:14px; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; position:relative; }
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
  .hero-title{ margin:0; font-size:30px; line-height:1.08; letter-spacing:-0.03em; font-weight:950; color:var(--ink); }
  @media(max-width:768px){ .hero-title{ font-size:24px; } }
  .hero-sub{ margin:8px 0 0; color:var(--muted); font-size:14px; line-height:1.8; max-width:920px; font-weight:800; }

  .actions{ display:flex; gap:10px; flex-wrap:wrap; align-items:center; justify-content:flex-end; }
  .btn{
    appearance:none; border:none; cursor:pointer;
    padding:10px 12px; border-radius:16px;
    font-weight:950; font-size:13px; color:var(--ink);
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
  .btn.primary{ background: linear-gradient(135deg, rgba(34,197,94,.18), rgba(96,165,250,.16)); border-color: rgba(34,197,94,.22); }
  .btn.danger{ background: rgba(239,68,68,.10); border-color: rgba(239,68,68,.20); color:#991b1b; }

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

  .grid{ display:grid; grid-template-columns: 1fr; gap:14px; }
  @media(min-width: 980px){ .grid{ grid-template-columns: 1.1fr .9fr; gap:18px; align-items:start; } }

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
  .hint{ color:var(--muted); font-size:12px; margin-top:6px; line-height:1.6; font-weight:800; }

  .input, .select, textarea{
    width:100%;
    border-radius:14px;
    border:1px solid rgba(15,23,42,.14);
    background: rgba(248,250,252,.95);
    padding:12px 12px;
    outline:none;
    color:var(--ink);
    font-weight:800;
  }
  textarea{ min-height:90px; resize:vertical; }
  .input:focus, .select:focus, textarea:focus{ border-color: rgba(16,185,129,.45); box-shadow: 0 0 0 4px rgba(16,185,129,.12); }

  .ferr{
    margin-top:8px;
    padding:10px 12px;
    border-radius: 14px;
    border:1px solid rgba(239,68,68,.25);
    background: rgba(239,68,68,.08);
    color:#7f1d1d;
    font-weight:850;
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
  .check b{ color:var(--ink); }
  .check span{ color:var(--muted); font-size:12px; line-height:1.6; font-weight:800; }

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
  .p-in{ position:relative; padding:18px; }
  .p-title{ margin:0; font-weight:950; letter-spacing:-.02em; font-size:16px; }
  .p-sub{ margin:6px 0 0; font-size:12px; color:var(--muted); font-weight:850; line-height:1.6; }

  .p-box{
    margin-top:14px;
    border-radius:18px;
    border:1px solid rgba(226,232,240,.9);
    background: rgba(255,255,255,.92);
    overflow:hidden;
  }
  .p-row{ display:flex; justify-content:space-between; gap:14px; padding:12px 14px; border-bottom:1px solid rgba(226,232,240,.8); }
  .p-row:last-child{ border-bottom:none; }
  .k{ font-size:11px; letter-spacing:.14em; text-transform:uppercase; color:var(--muted); font-weight:950; }
  .v{ font-weight:950; color:var(--ink); text-align:right; }

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
</style>

@php
  // Fallback aman jika controller belum kirim dusunOptions
  $dusunOptions = $dusunOptions ?? [
    'sawiru_kaler' => 'Sawiru Kaler',
    'sawiru_kidul' => 'Sawiru Kidul',
  ];
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
            <h1 class="hero-title">Tambah Data Penduduk</h1>
            <p class="hero-sub">
              Isi data pokok penduduk secara ringkas. Data dapat dinonaktifkan jika tidak ingin ditampilkan/diolah.
            </p>
          </div>
        </div>

        <div class="actions">
          <a class="btn" href="{{ route('admin.penduduk.index') }}">← Kembali</a>
          <button class="btn primary" type="submit" form="formCreate">💾 Simpan</button>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="pad">
        <div class="grid">

          {{-- FORM --}}
          <form id="formCreate" class="field" method="POST" action="{{ route('admin.penduduk.store') }}">
            @csrf

            <div class="row two">
              <div>
                <label for="nama">Nama</label>
                <input id="nama" name="nama" class="input" value="{{ old('nama') }}" maxlength="120" required
                       placeholder="Nama lengkap penduduk">
                @error('nama') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="nik">NIK (opsional)</label>
                <input id="nik" name="nik" class="input" value="{{ old('nik') }}" maxlength="32"
                       placeholder="Contoh: 3210xxxxxxxxxxxx">
                <div class="hint">Boleh kosong jika untuk demo/presentasi.</div>
                @error('nik') <div class="ferr">{{ $message }}</div> @enderror
              </div>
            </div>

            <div style="height:12px"></div>

            <div class="row two">
              <div>
                <label for="jk">Jenis Kelamin</label>
                <select id="jk" name="jk" class="select">
                  <option value="">Pilih</option>
                  <option value="L" @selected(old('jk') === 'L')>Laki-laki</option>
                  <option value="P" @selected(old('jk') === 'P')>Perempuan</option>
                </select>
                @error('jk') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="dusun">Dusun</label>
                <select id="dusun" name="dusun" class="select">
                  <option value="">Pilih</option>
                  @foreach($dusunOptions as $k => $lbl)
                    <option value="{{ $k }}" @selected(old('dusun') === (string)$k)>{{ $lbl }}</option>
                  @endforeach
                </select>
                @error('dusun') <div class="ferr">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="row two">
              <div>
                <label for="rt">RT (opsional)</label>
                <input id="rt" name="rt" class="input" value="{{ old('rt') }}" maxlength="8" placeholder="Contoh: 01">
                @error('rt') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div>
                <label for="rw">RW (opsional)</label>
                <input id="rw" name="rw" class="input" value="{{ old('rw') }}" maxlength="8" placeholder="Contoh: 02">
                @error('rw') <div class="ferr">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="row">
              <div>
                <label for="alamat">Alamat (opsional)</label>
                <textarea id="alamat" name="alamat" placeholder="Contoh: Kp. ....">{{ old('alamat') }}</textarea>
                @error('alamat') <div class="ferr">{{ $message }}</div> @enderror
              </div>

              <div class="check">
                <input id="aktif" type="checkbox" name="aktif" value="1" @checked(old('aktif', true))>
                <div>
                  <b>Aktifkan data</b><br>
                  <span>Jika dimatikan, data ditandai nonaktif untuk pengelolaan internal.</span>
                </div>
              </div>
              @error('aktif') <div class="ferr">{{ $message }}</div> @enderror
            </div>
          </form>

          {{-- PREVIEW --}}
          <div class="preview" aria-live="polite">
            <div class="p-in">
              <h3 class="p-title">Preview Data</h3>
              <p class="p-sub">Preview mengikuti input form secara realtime sebelum disimpan.</p>

              <div style="margin-top:10px;" id="pvStatus"></div>

              <div class="p-box">
                <div class="p-row"><span class="k">Nama</span><span class="v" id="pvNama">-</span></div>
                <div class="p-row"><span class="k">NIK</span><span class="v" id="pvNik">-</span></div>
                <div class="p-row"><span class="k">JK</span><span class="v" id="pvJk">-</span></div>
                <div class="p-row"><span class="k">Dusun</span><span class="v" id="pvDusun">-</span></div>
                <div class="p-row"><span class="k">RT/RW</span><span class="v" id="pvRtrw">-</span></div>
                <div class="p-row"><span class="k">Alamat</span><span class="v" id="pvAlamat">-</span></div>
              </div>

              <div class="hint" style="margin-top:12px;">
                Disarankan isi minimal: <b>Nama</b>, <b>Dusun</b>, dan <b>JK</b> agar data rapi.
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

  const nama = el('nama');
  const nik = el('nik');
  const jk = el('jk');
  const dusun = el('dusun');
  const rt = el('rt');
  const rw = el('rw');
  const alamat = el('alamat');
  const aktif = el('aktif');

  const pvNama = el('pvNama');
  const pvNik = el('pvNik');
  const pvJk = el('pvJk');
  const pvDusun = el('pvDusun');
  const pvRtrw = el('pvRtrw');
  const pvAlamat = el('pvAlamat');
  const pvStatus = el('pvStatus');

  const pill = (on) => {
    return on
      ? '<span class="pill ok"><span class="dot"></span>Aktif</span>'
      : '<span class="pill off"><span class="dot"></span>Nonaktif</span>';
  };

  const jkText = (v) => v === 'L' ? 'Laki-laki' : (v === 'P' ? 'Perempuan' : '-');

  const dusunText = () => {
    const opt = dusun && dusun.options ? dusun.options[dusun.selectedIndex] : null;
    const t = opt ? (opt.textContent || '').trim() : '';
    return t || '-';
  };

  const setPreview = () => {
    pvNama.textContent = (nama.value || '').trim() || '-';
    pvNik.textContent = (nik.value || '').trim() || '-';
    pvJk.textContent = jkText((jk.value || '').trim());
    pvDusun.textContent = dusunText();

    const rtv = (rt.value || '').trim();
    const rwv = (rw.value || '').trim();
    pvRtrw.textContent = (rtv || '-') + ' / ' + (rwv || '-');

    const al = (alamat.value || '').trim();
    pvAlamat.textContent = al !== '' ? (al.length > 48 ? al.slice(0,48) + '…' : al) : '-';

    pvStatus.innerHTML = pill(!!(aktif && aktif.checked));
  };

  ['input','change','keyup'].forEach(evt => {
    [nama, nik, jk, dusun, rt, rw, alamat].forEach(x => x && x.addEventListener(evt, setPreview));
  });
  if(aktif) aktif.addEventListener('change', setPreview);

  setPreview();
})();
</script>

@endsection
