<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use App\Models\StatistikPenduduk;
use App\Models\Umkm; // ✅ TAMBAHAN

class DashboardController extends Controller
{
    /**
     * Dashboard Admin Desa
     * - Ringkasan Perangkat Desa
     * - Ringkasan Statistik Penduduk
     * - Ringkasan UMKM
     */
    public function index()
    {
        /* =====================================================
         | PERANGKAT DESA
         ====================================================== */
        $totalPerangkat = PerangkatDesa::count();
        $aktifPerangkat = PerangkatDesa::where('aktif', true)->count();
        $nonaktifPerangkat = $totalPerangkat - $aktifPerangkat;

        /* =====================================================
         | STATISTIK PENDUDUK (DATA TERBARU)
         ====================================================== */
        $statistik = StatistikPenduduk::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $totalPenduduk = $statistik->total ?? 0;
        $lakiLaki      = $statistik->laki_laki ?? 0;
        $perempuan     = $statistik->perempuan ?? 0;

        /* =====================================================
         | UMKM DESA (🔥 TAMBAHAN BARU)
         ====================================================== */
        $totalUmkm  = Umkm::count();
        $umkmPublik = Umkm::where('status', 'publik')->count();
        $umkmDraft  = Umkm::where('status', 'draft')->count();

        /* =====================================================
         | KIRIM KE VIEW
         ====================================================== */
        return view('admin.dashboard', compact(
            'totalPerangkat',
            'aktifPerangkat',
            'nonaktifPerangkat',
            'totalPenduduk',
            'lakiLaki',
            'perempuan',
            'totalUmkm',
            'umkmPublik',
            'umkmDraft'
        ));
    }
}
