@extends('admin.layouts.app')

@section('title','UMKM Desa')

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
  max-width:1200px;
  margin:0 auto;
  padding:32px 24px 80px;
}

/* ===== HEADER ===== */
.header{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  gap:16px;
  margin-bottom:28px;
}

.header h1{
  margin:0;
  font-size:28px;
  font-weight:900;
  color:var(--ink);
}

.header p{
  margin:6px 0 0;
  color:var(--muted);
  font-size:14px;
  max-width:520px;
}

/* ===== BUTTON ===== */
.btn{
  background:linear-gradient(135deg,#059669,#047857);
  color:#fff;
  padding:12px 20px;
  border-radius:12px;
  font-weight:700;
  font-size:14px;
  text-decoration:none;
  box-shadow:0 10px 22px rgba(5,150,105,.28);
}

/* ===== CARD ===== */
.card{
  background:var(--card);
  border:1px solid var(--line);
  border-radius:20px;
  box-shadow:var(--shadow);
  padding:22px;
}

/* ===== TABLE ===== */
.table{
  width:100%;
  border-collapse:collapse;
}

.table thead th{
  text-align:left;
  font-size:13px;
  color:#475569;
  padding:14px 12px;
  border-bottom:1px solid var(--line);
  font-weight:800;
  text-transform:uppercase;
}

.table tbody td{
  padding:16px 12px;
  font-size:14px;
  border-bottom:1px solid var(--line);
}

/* ===== BADGE ===== */
.badge{
  padding:6px 14px;
  border-radius:999px;
  font-size:12px;
  font-weight:700;
}

.badge.green{
  background:var(--soft);
  color:var(--primary);
}

.badge.gray{
  background:#f1f5f9;
  color:#475569;
}

/* ===== ACTION ===== */
.action{
  font-weight:700;
  font-size:13px;
  margin-right:14px;
  color:#2563eb;
  background:none;
  border:none;
  padding:0;
  cursor:pointer;
}

.action.delete{
  color:#dc2626;
}

.action:hover{
  text-decoration:underline;
}

/* ===== EMPTY ===== */
.empty{
  text-align:center;
  padding:56px 24px;
  color:var(--muted);
  font-size:14px;
}
</style>

<div class="wrap">

  {{-- HEADER --}}
  <div class="header">
    <div>
      <h1>UMKM Desa</h1>
      <p>Pengelolaan data UMKM yang akan ditampilkan pada website desa.</p>
    </div>

    <a href="{{ route('admin.umkm.create') }}" class="btn">
      + Tambah UMKM
    </a>
  </div>

  {{-- CARD --}}
  <div class="card">

    <table class="table">
      <thead>
        <tr>
          <th>Nama Usaha</th>
          <th>Pelaku</th>
          <th>Kategori</th>
          <th>Status</th>
          <th width="160">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse($data as $item)
          <tr>
            <td><strong>{{ $item->nama_usaha }}</strong></td>
            <td>{{ $item->pelaku }}</td>
            <td>{{ $item->kategori }}</td>
            <td>
              @if($item->status === 'publik')
                <span class="badge green">Ditampilkan</span>
              @else
                <span class="badge gray">Draft</span>
              @endif
            </td>
            <td>
              <a href="{{ route('admin.umkm.edit', $item) }}" class="action">
                Edit
              </a>

              <form action="{{ route('admin.umkm.destroy', $item) }}"
                    method="POST"
                    style="display:inline"
                    onsubmit="return confirm('Yakin hapus UMKM ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action delete">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">
              <div class="empty">
                Belum ada data UMKM yang ditambahkan.
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

  </div>
</div>

@endsection
