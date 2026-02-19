@extends('admin.layouts.app')
@section('title','Detail Perangkat Desa • Admin')

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
    --shadow2: 0 10px 26px rgba(2,6,23,.06);
    --r16:16px; --r20:20px; --r24:24px;
  }

  .adm-wrap{ width:100%; padding:0 0 18px; }
  .container-max{ max-width:1100px; margin:0 auto; padding:0 2px; }

  /* HERO */
  .hero{
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    padding:18px;
    backdrop-filter: blur(10px);
    position:relative;
    overflow:hidden;
  }
  .hero::before{
    content:"";
    position:absolute; inset:-60px -40px auto auto;
    width:260px; height:260px;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.18), transparent 60%),
      radial-gradient(circle at 70% 70%, rgba(96,165,250,.18), transparent 60%),
      radial-gradient(circle at 50% 50%, rgba(168,85,247,.12), transparent 60%);
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

  .title{
    margin:0;
    font-size:28px;
    font-weight:950;
    letter-spacing:-.03em;
    color:var(--ink);
  }
  @media(max-width:768px){ .title{ font-size:24px; } }

  .sub{
    margin:6px 0 0;
    color:var(--muted);
    font-size:14px;
    line-height:1.7;
    font-weight:800;
    max-width:900px;
  }

  .actions{
    margin-top:10px;
    display:flex; gap:10px; flex-wrap:wrap;
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
    border:1px solid rgba(15,23,42,.14);
    box-shadow: var(--shadow2);
    text-decoration:none;
    display:inline-flex; align-items:center; gap:10px;
    transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
    backdrop-filter: blur(10px);
  }
  .btn:hover{ transform: translateY(-1px); box-shadow: 0 14px 30px rgba(2,6,23,.10); border-color: rgba(16,185,129,.25); }
  .btn svg{ width:18px; height:18px; }
  .btn.primary{
    background: linear-gradient(135deg, rgba(34,197,94,.18), rgba(96,165,250,.16));
    border-color: rgba(16,185,129,.25);
  }
  .btn.danger{
    background: rgba(239,68,68,.10);
    border-color: rgba(239,68,68,.22);
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
    overflow:hidden;
    backdrop-filter: blur(10px);
  }
  .pad{ padding:18px; }
  @media(min-width:768px){ .pad{ padding:22px; } }

  .grid{ display:grid; gap:14px; grid-template-columns:1fr; }
  @media(min-width: 900px){ .grid{ grid-template-columns: .92fr 1.08fr; gap:18px; align-items:start; } }

  /* PREVIEW CARD */
  .pv{
    border-radius: var(--r24);
    border:1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.95);
    box-shadow: 0 12px 28px rgba(2,6,23,.06);
    overflow:hidden;
    text-align:center;
    padding:18px;
  }
  .pv-img{
    width:160px; height:160px; margin:0 auto;
    border-radius:34px;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.94);
    box-shadow: 0 12px 26px rgba(2,6,23,.10);
    display:flex; align-items:center; justify-content:center;
    overflow:hidden;
  }
  .pv-img img{ width:100%; height:100%; object-fit:cover; object-position:50% 18%; display:block; }
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
  .pill.ok{ background: rgba(34,197,94,.10); border-color: rgba(34,197,94,.25); color:#065f46; }
  .pill.ok .dot{ background:#22c55e; }
  .pill.off{ background: rgba(239,68,68,.08); border-color: rgba(239,68,68,.22); color:#991b1b; }
  .pill.off .dot{ background:#ef4444; }

  .pv-badges{
    margin-top:12px;
    display:flex; gap:8px; flex-wrap:wrap;
    justify-content:center;
  }

  .pv-role{
    margin-top:14px;
    display:inline-flex;
    padding:8px 14px;
    border-radius:999px;
    border:1px solid rgba(16,185,129,.22);
    background: rgba(16,185,129,.10);
    color:#065f46;
    font-weight:950;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:12px;
    max-width: 100%;
  }
  .pv-name{ margin-top:10px; font-size:22px; font-weight:950; color:var(--ink); }

  .note{ margin-top:12px; font-size:12px; color:var(--muted); font-weight:800; line-height:1.6; }

  /* META TABLE */
  .meta{
    border-radius: var(--r24);
    border:1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.95);
    box-shadow: 0 12px 28px rgba(2,6,23,.06);
    overflow:hidden;
  }
  .meta h3{
    margin:0;
    padding:14px 16px;
    font-size:13px;
    font-weight:950;
    letter-spacing:.12em;
    text-transform:uppercase;
    border-bottom:1px solid rgba(15,23,42,.08);
    display:flex; align-items:center; justify-content:space-between; gap:10px;
  }
  .meta table{ width:100%; border-collapse:collapse; }
  .meta td{
    padding:12px 16px;
    border-bottom:1px solid rgba(15,23,42,.06);
    font-size:14px;
    vertical-align:top;
  }
  .meta tr:last-child td{ border-bottom:none; }
  .k{ width:210px; color:var(--muted); font-weight:950; }
  .v{ font-weight:900; color:var(--ink); }
  .mono{ font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace; font-size:12px; }

  .meta-actions{
    padding:14px 16px;
    border-top:1px solid rgba(15,23,42,.08);
    display:flex; gap:10px; flex-wrap:wrap;
  }
</style>

@php
  // jika controller mengirim $kategoriOptions, pakai itu (lebih konsisten)
  $kategoriLabel = null;
  if(isset($kategoriOptions) && is_array($kategoriOptions)){
    $kategoriLabel = $kategoriOptions[$item->kategori] ?? null;
  }
  $kategoriLabel = $kategoriLabel ?? (string)$item->kategori;

  $fotoUrl = function($path){
    $path = is_string($path) ? trim($path) : '';
    if ($path === '') return null;
    if (preg_match('~^https?://~i', $path)) return $path;
    return asset(ltrim($path, '/'));
  };

  $foto = $fotoUrl($item->foto ?? null);
  $nama = trim((string)($item->nama ?? '')) !== '' ? trim((string)$item->nama) : '_____';
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
            <h1 class="title">Detail Perangkat Desa</h1>
            <p class="sub">Menampilkan 1 data perangkat desa secara lengkap.</p>
          </div>
        </div>

        <div class="actions">
          <a class="btn" href="{{ route('admin.perangkat-desa.index') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
          </a>

          <a class="btn primary" href="{{ route('admin.perangkat-desa.edit', $item) }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            </svg>
            Edit
          </a>

          <form action="{{ route('admin.perangkat-desa.destroy', $item) }}" method="POST"
                onsubmit="return confirm('Yakin hapus data ini?');">
            @csrf
            @method('DELETE')
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

          {{-- PREVIEW --}}
          <div class="pv">
            <div class="pv-img" aria-hidden="true">
              @if($foto)
                <img src="{{ $foto }}" alt="foto"
                     onerror="this.remove(); this.parentElement.innerHTML='<span class=&quot;fallback&quot;>👤</span>';">
              @else
                <span class="fallback">👤</span>
              @endif
            </div>

            <div class="pv-badges">
              <span class="pill"><span class="dot"></span>{{ $kategoriLabel }}</span>

              @if($item->aktif)
                <span class="pill ok"><span class="dot"></span>Aktif</span>
              @else
                <span class="pill off"><span class="dot"></span>Nonaktif</span>
              @endif
            </div>

            <div class="pv-role">{{ $item->jabatan }}</div>
            <div class="pv-name">{{ $nama }}</div>

            <div class="note">
              Foto boleh kosong untuk tampilan profesional. Jika error, otomatis fallback 👤.
            </div>
          </div>

          {{-- META --}}
          <div class="meta">
            <h3>
              Informasi Data
              <span class="pill" title="Urutan tampil"><span class="dot"></span>Urutan: {{ $item->urutan }}</span>
            </h3>

            <table>
              <tr>
                <td class="k">Kategori</td>
                <td class="v">{{ $kategoriLabel }}</td>
              </tr>

              <tr>
                <td class="k">Jabatan</td>
                <td class="v">{{ $item->jabatan }}</td>
              </tr>

              <tr>
                <td class="k">Nama</td>
                <td class="v">{{ $nama }}</td>
              </tr>

              <tr>
                <td class="k">Status</td>
                <td class="v">
                  @if($item->aktif)
                    <span class="pill ok"><span class="dot"></span>Aktif</span>
                  @else
                    <span class="pill off"><span class="dot"></span>Nonaktif</span>
                  @endif
                </td>
              </tr>

              <tr>
                <td class="k">Foto (path/url)</td>
                <td class="v mono">{{ $item->foto ?: '-' }}</td>
              </tr>

              <tr>
                <td class="k">Dibuat</td>
                <td class="v">{{ optional($item->created_at)->format('d M Y H:i') }}</td>
              </tr>

              <tr>
                <td class="k">Diupdate</td>
                <td class="v">{{ optional($item->updated_at)->format('d M Y H:i') }}</td>
              </tr>
            </table>

            <div class="meta-actions">
              <a class="btn mini" href="{{ route('pemerintahan') }}" target="_blank" rel="noopener">
                👁️ Lihat Halaman Pemerintahan (Publik)
              </a>
              <a class="btn mini" href="{{ route('admin.perangkat-desa.edit', $item) }}">
                ✏️ Edit Data Ini
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
