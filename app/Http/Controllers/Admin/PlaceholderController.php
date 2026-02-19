<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PlaceholderController extends Controller
{
    /**
     * Placeholder: Data Penduduk (Admin)
     */
    public function penduduk()
    {
        return view('admin.placeholder', [
            'title'       => 'Data Penduduk Desa',
            'description' => 'Modul pengelolaan data penduduk desa secara terpusat (tanpa menampilkan data individu).',
            'features'    => [
                'Rekap Statistik Penduduk',
                'Filter Berdasarkan Periode',
                'Visualisasi Grafik',
                'Ekspor Laporan Resmi'
            ]
        ]);
    }

    /**
     * Placeholder: UMKM Desa (Admin)
     */
    public function umkm()
    {
        return view('admin.placeholder', [
            'title'       => 'UMKM Desa',
            'description' => 'Pendataan dan pengelolaan usaha mikro masyarakat desa untuk ditampilkan di website.',
            'features'    => [
                'Profil UMKM',
                'Kategori Usaha',
                'Galeri Produk',
                'Kontak Pelaku Usaha',
                'Kontrol Publikasi ke Website'
            ]
        ]);
    }

    /**
     * Placeholder: Wisata Desa (Admin)
     */
    public function wisata()
    {
        return view('admin.wisata.index', [
            'title'       => 'Wisata Desa',
            'description' => 'Manajemen potensi wisata desa dan publikasi ke halaman website resmi.',
            'features'    => [
                'Daftar Destinasi Wisata',
                'Foto & Deskripsi Lokasi',
                'Informasi Akses & Peta',
                'Kontrol Publikasi ke Website'
            ]
        ]);
    }
}
    