@extends('admin.layouts.app')

@section('title', 'Admin • Wisata Desa')

@section('content')

<style>
/* ===============================
   ADMIN WISATA — FINAL VERSION
=============================== */
.wisata-admin{
  --ink:#0f172a;
  --muted:#64748b;
  --line:rgba(15,23,42,.10);
  --primary:#2563eb;
  --danger:#dc2626;
  --bg:#f8fafc;
  --card:#ffffff;
  --shadow:0 18px 45px rgba(2,6,23,.08);
  --r20:20px;
}

/* WRAP */
.wisata-admin .wrap{
  background:var(--bg);
  padding:32px;
  border-radius:var(--r20);
}

/* HEADER */
.wisata-admin .head{
  display:flex;
  justify-content:space-between;
  gap:24px;
  flex-wrap:wrap;
}
.wisata-admin h1{
  font-size:28px;
  font-weight:900;
  color:var(--ink);
}
.wisata-admin .desc{
  margin-top:6px;
  font-size:14px;
  color:var(--muted);
  max-width:720px;
}
.wisata-admin .actions{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}
.wisata-admin .btn{
  padding:10px 18px;
  border-radius:999px;
  font-size:13px;
  font-weight:700;
  border:1px solid var(--line);
  background:#fff;
  color:var(--ink);
  text-decoration:none;
}
.wisata-admin .btn.primary{
  background:var(--primary);
  border-color:var(--primary);
  color:#fff;
}

/* TABLE */
.wisata-admin table{
  width:100%;
  margin-top:36px;
  border-collapse:collapse;
  background:#fff;
  border-radius:16px;
  overflow:hidden;
  box-shadow:var(--shadow);
}
.wisata-admin th{
  background:#f1f5f9;
  font-size:13px;
  font-weight:800;
  text-align:left;
}
.wisata-admin th,
.wisata-admin td{
  padding:14px;
  border-bottom:1px solid var(--line);
  font-size:14px;
  vertical-align:middle;
}

/* FOTO */
.thumb{
  width:70px;
  height:52px;
  object-fit:cover;
  border-radius:8px;
  border:1px solid var(--line);
  background:#e5e7eb;
}

/* BADGE */
.badge{
  padding:6px 12px;
  border-radius:999px;
  font-size:12px;
  font-weight:800;
}
.badge.Publik{
  background:#dcfce7;
  color:#166534;
}
.badge.Draft{
  background:#fef3c7;
  color:#92400e;
}

/* AKSI */
.aksi a{
  font-size:12px;
  font-weight:700;
  color:var(--primary);
  margin-right:10px;
}
.aksi button{
  font-size:12px;
  font-weight:700;
  background:none;
  border:none;
  color:var(--danger);
  cursor:pointer;
}

/* EMPTY */
.empty{
  text-align:center;
  padding:50px;
  color:var(--muted);
}
</style>

<div class="wisata-admin">
  <div class="wrap">

    {{-- HEADER --}}
    <div class="head">
      <div>
        <h1>Wisata Desa</h1>
        <p class="desc">
          Kelola seluruh data destinasi wisata desa.
          Data dengan status <b>Publik</b> otomatis tampil di halaman website publik.
        </p>
      </div>
      <div class="actions">
        <a href="{{ route('admin.wisata.create') }}" class="btn primary">
          + Tambah Destinasi
        </a>
        <a href="{{ route('wisata') }}" target="_blank" class="btn">
          Lihat Halaman Publik
        </a>
      </div>
    </div>

    {{-- TABLE --}}
    <table>
      <thead>
        <tr>
          <th width="90">Foto</th>
          <th>Nama & Lokasi</th>
          <th>Status</th>
          <th width="180">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $w)
        <tr>
          <td>
            @if($w->foto)
              <img src="{{ asset('storage/'.$w->foto) }}" class="thumb">
            @else
              <span class="badge Draft">No Foto</span>
            @endif
          </td>

          <td>
            <strong>{{ $w->nama }}</strong><br>
            <small style="color:#64748b">{{ $w->lokasi }}</small>
          </td>

          <td>
            <span class="badge {{ $w->status }}">
              {{ $w->status }}
            </span>
          </td>

          <td class="aksi">
            <a href="{{ route('admin.wisata.edit', $w->id) }}">Edit</a>

            {{-- 🔴 FORM DELETE (FIX 100%) --}}
            <form method="POST"
                  action="{{ route('admin.wisata.destroy', $w->id) }}"
                  style="display:inline"
                  onsubmit="return confirm('Yakin ingin menghapus destinasi ini? Data tidak bisa dikembalikan.')">
              @csrf
              @method('DELETE')
              <button type="submit">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="empty">
            Belum ada data wisata.<br>
            Klik <b>Tambah Destinasi</b> untuk mulai mengelola.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>

  </div>
</div>

@endsection
