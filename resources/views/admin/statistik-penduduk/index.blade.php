{{-- resources/views/admin/statistik-penduduk/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Statistik Penduduk')

@section('content')

<style>
  /* ===============================
     STYLE KHUSUS HALAMAN INI
     =============================== */
  .stat-wrap{
    max-width:1200px;
    margin:0 auto;
    padding:28px 0;
  }

  .stat-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:20px;
    margin-bottom:26px;
    flex-wrap:wrap;
  }

  .stat-title h1{
    margin:0;
    font-size:26px;
    font-weight:900;
    color:#0f172a;
  }

  .stat-title p{
    margin-top:6px;
    font-size:14px;
    color:#64748b;
    max-width:720px;
  }

  .stat-actions a{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 16px;
    border-radius:10px;
    background:#047857;
    color:#fff;
    text-decoration:none;
    font-size:14px;
    font-weight:700;
  }

  /* ===== TABLE CARD ===== */
  .card{
    background:#ffffff;
    border-radius:18px;
    border:1px solid rgba(15,23,42,.08);
    box-shadow:0 18px 40px rgba(2,6,23,.08);
    overflow:hidden;
  }

  table{
    width:100%;
    border-collapse:collapse;
  }

  thead{
    background:#f8fafc;
  }

  th{
    padding:14px 12px;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.06em;
    color:#475569;
    text-align:center;
    border-bottom:1px solid rgba(15,23,42,.08);
  }

  td{
    padding:14px 12px;
    font-size:14px;
    color:#0f172a;
    text-align:center;
    border-bottom:1px solid rgba(15,23,42,.06);
  }

  td strong{
    font-weight:900;
  }

  tbody tr:hover{
    background:#f9fafb;
  }

  /* ===== BADGE ===== */
  .badge{
    display:inline-block;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
  }

  .badge.total{
    background:#e0f2fe;
    color:#075985;
  }

  .badge.l{
    background:#ecfdf5;
    color:#065f46;
  }

  .badge.p{
    background:#fdf2f8;
    color:#9d174d;
  }

  /* ===== ACTION ===== */
  .action{
    display:inline-flex;
    gap:10px;
    justify-content:center;
  }

  .action a{
    font-size:13px;
    font-weight:700;
    color:#2563eb;
    text-decoration:none;
  }

  .action a:hover{
    text-decoration:underline;
  }

  /* ===== EMPTY ===== */
  .empty{
    padding:40px;
    text-align:center;
    color:#64748b;
    font-size:14px;
  }

  /* ===== PAGINATION ===== */
  .pagination-wrap{
    padding:18px;
    display:flex;
    justify-content:flex-end;
  }

  @media(max-width:768px){
    th, td{ font-size:12px; padding:10px }
    .stat-title h1{ font-size:22px }
  }
</style>

<div class="stat-wrap">

  {{-- HEADER --}}
  <div class="stat-head">
    <div class="stat-title">
      <h1>Statistik Penduduk Desa</h1>
      <p>
        Rekapitulasi data kependudukan per bulan berdasarkan laporan resmi desa.
        Data ini bersifat agregat (tanpa data individu) dan digunakan untuk
        kebutuhan administrasi, perencanaan, dan pelaporan desa.
      </p>
    </div>

    <div class="stat-actions">
      <a href="{{ route('admin.statistik-penduduk.create') }}">
        + Tambah Statistik Bulanan
      </a>
    </div>
  </div>

  {{-- TABLE --}}
  <div class="card">
    <table>
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Bulan</th>
          <th>Total Penduduk</th>
          <th>Laki-laki</th>
          <th>Perempuan</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($rows as $row)
          <tr>
            <td>{{ $row->tahun }}</td>
            <td>{{ \Carbon\Carbon::create()->month($row->bulan)->translatedFormat('F') }}</td>

            <td>
              <span class="badge total">
                {{ number_format($row->total) }}
              </span>
            </td>

            <td>
              <span class="badge l">
                {{ number_format($row->laki_laki) }}
              </span>
            </td>

            <td>
              <span class="badge p">
                {{ number_format($row->perempuan) }}
              </span>
            </td>

            <td>
              <div class="action">
                <a href="{{ route('admin.statistik-penduduk.edit', $row->id) }}">
                  Edit
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6">
              <div class="empty">
                Belum ada data statistik penduduk yang dimasukkan.
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- PAGINATION --}}
    @if($rows->hasPages())
      <div class="pagination-wrap">
        {{ $rows->links() }}
      </div>
    @endif
  </div>

</div>

@endsection
