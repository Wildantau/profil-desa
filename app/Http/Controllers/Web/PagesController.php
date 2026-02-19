<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\StatistikPenduduk;
use App\Models\PerangkatDesa;
use App\Models\Wisata;
use App\Models\Umkm;
use App\Models\ProfilDesa; // WAJIB untuk koneksi profil admin

class PagesController extends Controller
{
    /* =====================================================
     | HALAMAN UTAMA
     | ===================================================== */
    public function home()
    {
        return view('web.home');
    }

    /* =====================================================
     | PROFIL DESA (TERHUBUNG ADMIN)
     | ===================================================== */
    public function profil()
    {
        // Ambil profil aktif (single row ID=1)
        $profil = ProfilDesa::where('aktif', true)->first();

        return view('web.profil', compact('profil'));
    }

    /* =====================================================
     | DATA PENDUDUK (PUBLIK)
     | ===================================================== */
    public function dataPenduduk()
    {
        $statistik = StatistikPenduduk::latestPeriod()->first();

        if (!$statistik) {
            return view('web.data-penduduk', [
                'statistik' => null,
                'usia' => [],
                'pekerjaan' => [],
                'pendidikan' => [],
                'agama' => [],
                'chartPenduduk' => [
                    'labels' => ['Laki-laki', 'Perempuan'],
                    'data'   => [0, 0],
                ],
            ]);
        }

        $chartPenduduk = [
            'labels' => ['Laki-laki', 'Perempuan'],
            'data'   => [
                (int) $statistik->laki_laki,
                (int) $statistik->perempuan,
            ],
        ];

        return view('web.data-penduduk', [
            'statistik' => $statistik,
            'usia'       => $statistik->usia ?? [],
            'pekerjaan'  => $statistik->pekerjaan ?? [],
            'pendidikan' => $statistik->pendidikan ?? [],
            'agama'      => $statistik->agama ?? [],
            'chartPenduduk' => $chartPenduduk,
        ]);
    }

    /* =====================================================
     | PEMERINTAHAN DESA
     | ===================================================== */
    public function pemerintahan()
    {
        $rows = PerangkatDesa::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        $data = [
            'kepala_desa' => collect(),
            'sekretaris'  => collect(),
            'kasi'        => collect(),
            'kaur'        => collect(),
            'dusun'       => collect(),
        ];

        foreach ($rows as $item) {
            $kategori = strtolower(trim($item->kategori ?? ''));

            if (str_contains($kategori, 'kepala') && str_contains($kategori, 'desa')) {
                $data['kepala_desa']->push($item);
            } elseif (str_contains($kategori, 'sekretaris')) {
                $data['sekretaris']->push($item);
            } elseif (str_contains($kategori, 'kasi')) {
                $data['kasi']->push($item);
            } elseif (str_contains($kategori, 'kaur')) {
                $data['kaur']->push($item);
            } elseif (str_contains($kategori, 'dusun') || str_contains($kategori, 'kadus')) {
                $data['dusun']->push($item);
            }
        }

        return view('web.pemerintahan', compact('data'));
    }

    /* =====================================================
     | WISATA DESA
     | ===================================================== */
    public function wisata()
    {
        $wisata = Wisata::publik()
            ->latest()
            ->get();

        return view('web.wisata', compact('wisata'));
    }

    /* =====================================================
     | UMKM DESA (TERHUBUNG DATABASE)
     | ===================================================== */
    public function umkm()
    {
        $umkm = Umkm::publik()
            ->latest()
            ->get();

        return view('web.umkm', compact('umkm'));
    }

    /* =====================================================
     | UMKM DETAIL
     | ===================================================== */
    public function umkmDetail(Umkm $umkm)
    {
        // Jangan tampilkan jika status draft
        abort_if($umkm->status !== Umkm::STATUS_PUBLIK, 404);

        return view('web.umkm-detail', compact('umkm'));
    }

    /* =====================================================
     | PETA WILAYAH
     | ===================================================== */
    public function petaWilayah()
    {
        return view('web.peta-wilayah');
    }

    /* =====================================================
     | KONTAK
     | ===================================================== */
    public function kontak()
    {
        return view('web.kontak');
    }
}
