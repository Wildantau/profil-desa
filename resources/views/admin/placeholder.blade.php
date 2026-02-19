@extends('admin.layouts.app')

@section('title', ($title ?? 'Modul Admin').' • Admin')

@section('content')

<style>
  .ph-wrap{
    max-width:1100px;
    margin:0 auto;
    padding:20px;
  }
  .ph-card{
    background: var(--card,#ffffff);
    border:1px solid var(--line,rgba(0,0,0,.08));
    border-radius: 24px;
    box-shadow: var(--shadow,0 10px 30px rgba(0,0,0,.08));
    padding:28px;
  }
  .ph-title{
    font-size:28px;
    font-weight:900;
    color:var(--ink,#0f172a);
    letter-spacing:-.02em;
  }
  .ph-desc{
    margin-top:10px;
    color:var(--muted,#475569);
    font-size:14px;
    font-weight:600;
    max-width:760px;
    line-height:1.8;
  }
  .ph-status{
    margin-top:18px;
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 14px;
    border-radius:999px;
    font-weight:700;
    font-size:12px;
    background: rgba(34,197,94,.10);
    border:1px solid rgba(34,197,94,.25);
    color:#065f46;
  }
  .ph-list{
    margin-top:24px;
    display:grid;
    gap:12px;
  }
  .ph-item{
    padding:14px 16px;
    border-radius:16px;
    border:1px dashed var(--line,rgba(0,0,0,.15));
    background: rgba(248,250,252,.85);
    font-weight:600;
    color:var(--ink,#0f172a);
  }
</style>

<div class="ph-wrap">
  <div class="ph-card">

    {{-- JUDUL --}}
    <h1 class="ph-title">
      {{ $title ?? 'Modul Admin Desa' }}
    </h1>

    {{-- DESKRIPSI --}}
    <p class="ph-desc">
      {{ $description ?? 'Modul ini masih dalam tahap perencanaan dan pengembangan.' }}
    </p>

    {{-- STATUS --}}
    <div class="ph-status">
      <span>●</span> Modul siap dikembangkan
    </div>

    {{-- FITUR --}}
    <div class="ph-list">
      @forelse(($features ?? []) as $f)
        <div class="ph-item">✔ {{ $f }}</div>
      @empty
        <div class="ph-item">
          ✔ Fitur akan ditambahkan sesuai kebutuhan desa
        </div>
      @endforelse
    </div>

    {{-- CATATAN --}}
    <p class="ph-desc" style="margin-top:20px">
      Modul ini telah disiapkan strukturnya dan akan diaktifkan secara bertahap
      setelah tahap KKN dan validasi sistem selesai.
    </p>

  </div>
</div>

@endsection
