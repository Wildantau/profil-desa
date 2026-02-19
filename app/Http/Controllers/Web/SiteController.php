<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\Penduduk;

class SiteController extends Controller
{
    /* =========================
     * HALAMAN UMUM
     * ========================= */
    public function home()
    {
        return view('web.home');
    }

    /**
     * PROFIL DESA + DATA PENDUDUK (FINAL)
     */
    public function profil()
    {
        // Ambil 1 data profil desa
        $profil = ProfilDesa::first();

        // Ambil semua penduduk (urut nama)
        $penduduks = Penduduk::orderBy('nama', 'asc')->get();

        return view('web.profil', compact('profil', 'penduduks'));
    }

    /**
     * Halaman Data Penduduk (jika dipisah)
     */
    public function dataPenduduk()
    {
        $penduduks = Penduduk::orderBy('nama', 'asc')->get();
        return view('web.data-penduduk', compact('penduduks'));
    }

    public function dusun()
    {
        return view('web.dusun');
    }

    public function umkm()
    {
        return view('web.umkm');
    }

    public function wisata()
    {
        return view('web.wisata');
    }

    public function petaWilayah()
    {
        return view('web.peta-wilayah');
    }

    public function pemerintahan()
    {
        return view('web.pemerintahan');
    }

    public function kontak()
    {
        return view('web.kontak');
    }

    /* =========================
     * DOWNLOAD FILE
     * ========================= */
    public function downloadProfil()
    {
        $path = public_path('docs/profil-desa-surianmedal.pdf');
        abort_unless(file_exists($path), 404, 'File profil desa belum tersedia.');

        return response()->download(
            $path,
            'Profil-Desa-Surianmedal.pdf'
        );
    }

    public function downloadPeta()
    {
        $path = public_path('docs/peta-wilayah-surianmedal.pdf');
        abort_unless(file_exists($path), 404, 'File peta wilayah belum tersedia.');

        return response()->download(
            $path,
            'Peta-Wilayah-Desa-Surianmedal.pdf'
        );
    }
}
