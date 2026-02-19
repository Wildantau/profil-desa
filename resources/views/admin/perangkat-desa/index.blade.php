@extends('admin.layouts.app')
@section('title','Admin • Perangkat Desa')

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
    background: linear-gradient(135deg, rgba(34,197,94,.18), rgba(96,165,250,.16));
    border-color: rgba(34,197,94,.22);
  }
  .btn.danger{
    background: rgba(239,68,68,.10);
    border-color: rgba(239,68,68,.20);
    color:#991b1b;
  }

  .panel{
    margin-top:14px;
    background: var(--card);
    border:1px solid var(--line);
    border-radius: var(--r24);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
    overflow:hidden;
  }
  .panel-pad{ padding:16px; }
  @media(min-width:768px){ .panel-pad{ padding:18px; } }

  /* FILTER BAR */
  .filters{
    display:grid;
    grid-template-columns: 1fr;
    gap:10px;
    margin-bottom:12px;
  }
  @media(min-width: 900px){
    .filters{ grid-template-columns: 1.2fr .6fr .5fr .7fr; align-items:center; }
  }
  .field{
    display:flex; gap:10px; align-items:center;
    padding:10px 12px;
    border-radius: 18px;
    background: rgba(255,255,255,.92);
    border: 1px solid rgba(15,23,42,.12);
    box-shadow: var(--shadow2);
    backdrop-filter: blur(10px);
  }
  .field input, .field select{
    width:100%;
    border:none; outline:none;
    background:transparent;
    font-weight:900;
    color: var(--ink);
    font-size:14px;
  }
  .field label{
    font-size:12px;
    color: var(--muted);
    font-weight:950;
    letter-spacing:.12em;
    text-transform:uppercase;
    white-space:nowrap;
  }
  .filter-actions{
    display:flex; gap:10px; flex-wrap:wrap;
    justify-content:flex-end;
  }

  .filter-hint{
    margin:8px 0 0;
    font-size:12px;
    color: var(--muted);
    font-weight:900;
    line-height:1.6;
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    align-items:center;
  }

  /* TABLE */
  .table-wrap{
    margin-top:10px;
    border:1px solid rgba(226,232,240,.95);
    border-radius:18px;
    overflow:hidden;
    background: rgba(255,255,255,.92);
  }
  table{ width:100%; border-collapse:separate; border-spacing:0; }
  thead th{
    text-align:left;
    font-size:11px;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:var(--muted);
    font-weight:950;
    padding:12px 14px;
    background: rgba(255,255,255,.98);
    border-bottom:1px solid rgba(226,232,240,.9);
    white-space:nowrap;
  }
  tbody td{
    padding:12px 14px;
    border-bottom:1px solid rgba(226,232,240,.7);
    color:var(--ink);
    font-size:14px;
    background: rgba(255,255,255,.92);
    vertical-align:middle;
  }
  tbody tr:last-child td{ border-bottom:none; }

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

  .row-actions{
    display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;
  }
  .mini{ padding:8px 10px; border-radius:14px; font-size:12px; }

  .muted{ color: var(--muted); font-weight:900; }
  .nowrap{ white-space:nowrap; }

  /* AVATAR */
  .ava{
    width:42px; height:42px;
    border-radius:14px;
    overflow:hidden;
    border:1px solid rgba(15,23,42,.12);
    background: rgba(248,250,252,.95);
    box-shadow: 0 10px 22px rgba(2,6,23,.07);
    display:flex; align-items:center; justify-content:center;
    flex:0 0 auto;
  }
  .ava img{ width:100%; height:100%; object-fit:cover; object-position:50% 18%; display:block; }
  .ava .fb{ font-size:22px; opacity:.9; }

  /* Empty state */
  .empty{
    padding:18px 16px;
    color:var(--muted);
    font-weight:900;
  }
  .empty b{ color:var(--ink); }
  .empty .cta{ margin-top:10px; display:flex; gap:10px; flex-wrap:wrap; }

  .pagination-wrap{ margin-top:12px; }

  /* Responsive: table -> cards */
  @media(max-width: 860px){
    thead{ display:none; }
    table, tbody, tr, td{ display:block; width:100%; }
    tbody tr{ border-bottom:1px solid rgba(226,232,240,.9); }
    tbody tr:last-child{ border-bottom:none; }
    tbody td{ border-bottom:none; padding:12px 14px; }
    .td-grid{ display:grid; grid-template-columns: 1fr; gap:10px; }
    .row-actions{ justify-content:flex-start; }
    .stack{ display:flex; flex-wrap:wrap; gap:10px; align-items:center; }
    .kv{ display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
    .k{ font-size:11px; letter-spacing:.14em; text-transform:uppercase; color:var(--muted); font-weight:950; }
    .who{ display:flex; align-items:center; gap:12px; min-width: 220px; }
    .who b{ display:block; line-height:1.2; }
    .who .small{ display:block; margin-top:3px; font-size:12px; color:var(--muted); font-weight:900; }
  }
</style>

@php
  // Aman kalau controller belum kirim apa-apa
  $rows = $rows ?? collect();
  $q = $q ?? request('q','');
  $kategori = $kategori ?? request('kategori','');
  $aktif = $aktif ?? request('aktif','');

  $kategoriOptions = $kategoriOptions ?? [];

  $katLabel = function($key) use ($kategoriOptions){
    return $kategoriOptions[$key] ?? $key;
  };

  $fotoUrl = function($path){
    $path = is_string($path) ? trim($path) : '';
    if ($path === '') return null;
    if (preg_match('~^https?://~i', $path)) return $path;
    return asset(ltrim($path, '/'));
  };

  $isFiltering = (trim((string)$q) !== '') || ((string)$kategori !== '') || ((string)$aktif !== '');
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
            <h1 class="hero-title">Admin • Perangkat Desa</h1>
            <p class="hero-sub">
              Kelola data <b>perangkat_desa</b> (SQLite). Data ini otomatis dipakai di halaman <b>Pemerintahan</b>.
            </p>
          </div>
        </div>

        <div class="actions">
          <a class="btn primary" href="{{ route('admin.perangkat-desa.create') }}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 5v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah Data
          </a>

          <a class="btn" href="{{ route('pemerintahan') }}" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="2"/>
              <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="2"/>
            </svg>
            Lihat Halaman Pemerintahan
          </a>
        </div>
      </div>
    </div>

    <div class="panel">
      <div class="panel-pad">

        {{-- FILTERS --}}
        <form method="GET" action="{{ route('admin.perangkat-desa.index') }}" class="filters">
          <div class="field">
            <label>Cari</label>
            <input type="text" name="q" value="{{ $q }}" placeholder="Nama / Jabatan..." />
          </div>

          <div class="field">
            <label>Kategori</label>
            <select name="kategori">
              <option value="">Semua</option>
              @foreach($kategoriOptions as $k => $lbl)
                <option value="{{ $k }}" @selected((string)$kategori === (string)$k)>{{ $lbl }}</option>
              @endforeach
            </select>
          </div>

          <div class="field">
            <label>Status</label>
            <select name="aktif">
              <option value="">Semua</option>
              <option value="1" @selected((string)$aktif === '1')>Aktif</option>
              <option value="0" @selected((string)$aktif === '0')>Nonaktif</option>
            </select>
          </div>

          <div class="filter-actions">
            <button class="btn" type="submit">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 4h16l-6 7v7l-4 2v-9L4 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              </svg>
              Terapkan
            </button>

            @if($isFiltering)
              <a class="btn" href="{{ route('admin.perangkat-desa.index') }}">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M21 12a9 9 0 1 1-3-6.7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M21 3v7h-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Reset
              </a>
            @endif
          </div>
        </form>

        @if($isFiltering)
          <div class="filter-hint">
            <span class="pill"><span class="dot"></span>Mode Filter</span>
            @if(trim((string)$q) !== '')
              <span class="pill"><span class="dot"></span>Cari: <b style="margin-left:6px;">{{ $q }}</b></span>
            @endif
            @if((string)$kategori !== '')
              <span class="pill"><span class="dot"></span>Kategori: <b style="margin-left:6px;">{{ $katLabel($kategori) }}</b></span>
            @endif
            @if((string)$aktif !== '')
              <span class="pill"><span class="dot"></span>Status:
                <b style="margin-left:6px;">{{ (string)$aktif === '1' ? 'Aktif' : 'Nonaktif' }}</b>
              </span>
            @endif
          </div>
        @endif

        {{-- TABLE --}}
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th style="width:70px;">Foto</th>
                <th style="width:60px;">#</th>
                <th>Kategori</th>
                <th>Jabatan</th>
                <th>Nama</th>
                <th class="nowrap">Urutan</th>
                <th class="nowrap">Aktif</th>
                <th style="width:320px; text-align:right;">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse($rows as $i => $r)
                @php $img = $fotoUrl($r->foto ?? null); @endphp
                <tr>
                  <td class="nowrap">
                    <div class="ava" aria-hidden="true">
                      @if($img)
                        <img src="{{ $img }}" alt="foto"
                             onerror="this.remove(); this.parentElement.innerHTML = '<span class=&quot;fb&quot;>👤</span>';">
                      @else
                        <span class="fb">👤</span>
                      @endif
                    </div>
                  </td>

                  <td class="muted">
                    @if(method_exists($rows,'firstItem') && $rows->firstItem())
                      {{ $rows->firstItem() + $i }}
                    @else
                      {{ $i + 1 }}
                    @endif
                  </td>

                  <td>
                    <span class="pill">
                      <span class="dot"></span>
                      {{ $katLabel($r->kategori) }}
                    </span>
                  </td>

                  <td><b>{{ $r->jabatan }}</b></td>
                  <td>{{ $r->nama ?: '_____' }}</td>
                  <td class="nowrap">{{ $r->urutan }}</td>

                  <td class="nowrap">
                    @if($r->aktif)
                      <span class="pill ok"><span class="dot"></span>Aktif</span>
                    @else
                      <span class="pill off"><span class="dot"></span>Nonaktif</span>
                    @endif
                  </td>

                  <td>
                    <div class="row-actions">
                      <a class="btn mini" href="{{ route('admin.perangkat-desa.show', $r) }}">
                        <svg viewBox="0 0 24 24" fill="none">
                          <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="2"/>
                          <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Detail
                      </a>

                      <a class="btn mini" href="{{ route('admin.perangkat-desa.edit', $r) }}">
                        <svg viewBox="0 0 24 24" fill="none">
                          <path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                          <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                        Edit
                      </a>

                      <form method="POST" action="{{ route('admin.perangkat-desa.destroy', $r) }}"
                            onsubmit="return confirm('Hapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn mini danger" type="submit">
                          <svg viewBox="0 0 24 24" fill="none">
                            <path d="M3 6h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M8 6V4h8v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M6 6l1 16h10l1-16" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                          </svg>
                          Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="empty">
                    <b>Belum ada data perangkat desa.</b><br>
                    Untuk demo yang terlihat profesional, isi minimal 5 data (foto + jabatan).<br>
                    <div class="cta">
                      <a class="btn primary" href="{{ route('admin.perangkat-desa.create') }}">➕ Tambah Data</a>
                      <a class="btn" href="{{ route('pemerintahan') }}" target="_blank" rel="noopener">👁️ Lihat Publik</a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="pagination-wrap">
          @if(method_exists($rows,'appends'))
            {{ $rows->appends(request()->query())->links() }}
          @else
            {{-- fallback kalau bukan paginator --}}
          @endif
        </div>

      </div>
    </div>

  </div>
</div>

<script>
/**
 * Mobile cards via JS (<=860px) tanpa merusak tampilan desktop.
 * - Aman: tidak double-build, handle empty/colspan row, dan restore saat resize.
 */
(function(){
  const mq = window.matchMedia('(max-width: 860px)');
  const table = document.querySelector('.table-wrap table');
  if(!table) return;

  const cleanupMobile = () => {
    table.querySelectorAll('tr[data-mobile="1"]').forEach(n => n.remove());
    table.querySelectorAll('tbody > tr').forEach(tr => {
      if(tr.getAttribute('data-origin-hidden') === '1'){
        tr.style.display = '';
        tr.removeAttribute('data-origin-hidden');
      }
    });
  };

  const buildMobile = () => {
    cleanupMobile();
    if(!mq.matches) return;

    const rows = Array.from(table.querySelectorAll('tbody > tr'))
      .filter(tr => tr.getAttribute('data-mobile') !== '1');

    rows.forEach(tr => {
      const tds = tr.querySelectorAll('td');
      // skip row empty/colspan
      if(tds.length < 8) return;

      const foto = tds[0].innerHTML;
      const nomor = (tds[1].textContent || '').trim();
      const kategori = tds[2].innerHTML;
      const jabatan = tds[3].innerHTML;
      const nama = (tds[4].innerHTML || '').trim();
      const urutan = (tds[5].textContent || '').trim();
      const aktif = tds[6].innerHTML;
      const aksi = tds[7].innerHTML;

      const card = document.createElement('tr');
      card.setAttribute('data-mobile','1');

      const cell = document.createElement('td');
      cell.colSpan = 8;
      cell.style.padding = '12px 14px';

      cell.innerHTML = `
        <div class="td-grid">
          <div class="who">
            ${foto}
            <div>
              <b>${jabatan}</b>
              <span class="small">No: <span style="color:#0f172a">${nomor}</span> • Urutan: <span style="color:#0f172a">${urutan}</span></span>
            </div>
          </div>

          <div class="stack">
            <div class="kv"><span class="k">Kategori</span>${kategori}</div>
            <div class="kv"><span class="k">Nama</span><span style="font-weight:900;color:#0f172a">${nama || '_____'}</span></div>
            <div class="kv"><span class="k">Status</span>${aktif}</div>
          </div>

          <div class="row-actions">${aksi}</div>
        </div>
      `;

      card.appendChild(cell);
      tr.after(card);
      tr.style.display = 'none';
      tr.setAttribute('data-origin-hidden','1');
    });
  };

  const refresh = () => buildMobile();

  refresh();
  if(mq.addEventListener){
    mq.addEventListener('change', refresh);
  } else {
    window.addEventListener('resize', refresh);
  }
})();
</script>

@endsection
 