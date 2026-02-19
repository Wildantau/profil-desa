<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikPenduduk;
use Illuminate\Http\Request;

/**
 * ============================================================
 * STATISTIK PENDUDUK CONTROLLER
 * ============================================================
 * Fungsi:
 * - CRUD statistik penduduk bulanan
 * - Sumber data halaman publik & dashboard
 *
 * Prinsip:
 * - TANPA data individu (aman privasi)
 * - Data agregat
 * - Mendukung SMART VILLAGE (JSON fleksibel)
 *
 * Digunakan oleh:
 * - Aparat Desa (Admin Panel)
 * - Halaman Publik (visualisasi grafik)
 * ============================================================
 */
class StatistikPendudukController extends Controller
{
    /* ============================================================
     * INDEX
     * ------------------------------------------------------------
     * Menampilkan daftar statistik penduduk per bulan
     * ============================================================ */
    public function index()
    {
        $rows = StatistikPenduduk::query()
            ->latestPeriod()
            ->paginate(12);

        return view('admin.statistik-penduduk.index', compact('rows'));
    }

    /* ============================================================
     * CREATE
     * ------------------------------------------------------------
     * Menampilkan form input statistik baru
     * ============================================================ */
    public function create()
    {
        return view('admin.statistik-penduduk.create');
    }

    /* ============================================================
     * STORE
     * ------------------------------------------------------------
     * Menyimpan data statistik penduduk baru
     * ============================================================ */
    public function store(Request $request)
    {
        // ================= VALIDASI =================
        $validated = $request->validate([
            'tahun'       => ['required','integer','min:2000','max:2100'],
            'bulan'       => ['required','integer','between:1,12'],

            'laki_laki'   => ['required','integer','min:0'],
            'perempuan'   => ['required','integer','min:0'],

            'keterangan'  => ['nullable','string','max:255'],

            // SMART VILLAGE (JSON)
            'usia'        => ['nullable','array'],
            'pekerjaan'   => ['nullable','array'],
            'pendidikan'  => ['nullable','array'],
            'agama'       => ['nullable','array'],
        ]);

        // ================= CEGAH DUPLIKASI =================
        if ($this->isDuplicatePeriod(
            $validated['tahun'],
            $validated['bulan']
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'bulan' => 'Data statistik untuk bulan & tahun ini sudah ada.'
                ]);
        }

        // ================= HITUNG TOTAL =================
        $total = $validated['laki_laki'] + $validated['perempuan'];

        // ================= NORMALISASI JSON =================
        $jsonData = $this->prepareJsonPayload($request);

        // ================= SIMPAN =================
        StatistikPenduduk::create(array_merge([
            'tahun'       => $validated['tahun'],
            'bulan'       => $validated['bulan'],
            'laki_laki'   => $validated['laki_laki'],
            'perempuan'   => $validated['perempuan'],
            'total'       => $total,
            'keterangan'  => $validated['keterangan'] ?? null,
        ], $jsonData));

        return redirect()
            ->route('admin.statistik-penduduk.index')
            ->with('success','Data statistik penduduk berhasil ditambahkan.');
    }

    /* ============================================================
     * EDIT
     * ------------------------------------------------------------
     * Menampilkan form edit statistik
     * ============================================================ */
    public function edit(StatistikPenduduk $statistik_penduduk)
    {
        return view('admin.statistik-penduduk.edit', [
            'row' => $statistik_penduduk
        ]);
    }

    /* ============================================================
     * UPDATE
     * ------------------------------------------------------------
     * Memperbarui data statistik penduduk
     * ============================================================ */
    public function update(Request $request, StatistikPenduduk $statistik_penduduk)
    {
        $validated = $request->validate([
            'laki_laki'   => ['required','integer','min:0'],
            'perempuan'   => ['required','integer','min:0'],
            'keterangan'  => ['nullable','string','max:255'],

            'usia'        => ['nullable','array'],
            'pekerjaan'   => ['nullable','array'],
            'pendidikan'  => ['nullable','array'],
            'agama'       => ['nullable','array'],
        ]);

        $total = $validated['laki_laki'] + $validated['perempuan'];
        $jsonData = $this->prepareJsonPayload($request);

        $statistik_penduduk->update(array_merge([
            'laki_laki'   => $validated['laki_laki'],
            'perempuan'   => $validated['perempuan'],
            'total'       => $total,
            'keterangan'  => $validated['keterangan'] ?? null,
        ], $jsonData));

        return redirect()
            ->route('admin.statistik-penduduk.index')
            ->with('success','Data statistik penduduk berhasil diperbarui.');
    }

    /* ============================================================
     * DESTROY
     * ============================================================ */
    public function destroy(StatistikPenduduk $statistik_penduduk)
    {
        $statistik_penduduk->delete();

        return redirect()
            ->route('admin.statistik-penduduk.index')
            ->with('success','Data statistik penduduk berhasil dihapus.');
    }

    /* ============================================================
     * ===================== HELPER ===============================
     * ============================================================ */

    /**
     * Cek apakah periode sudah ada
     */
    private function isDuplicatePeriod(int $tahun, int $bulan): bool
    {
        return StatistikPenduduk::where('tahun',$tahun)
            ->where('bulan',$bulan)
            ->exists();
    }

    /**
     * Siapkan & bersihkan payload JSON Smart Village
     */
    private function prepareJsonPayload(Request $request): array
    {
        return [
            'usia'       => $this->normalizeJsonArray($request->input('usia', [])),
            'pekerjaan'  => $this->normalizeJsonArray($request->input('pekerjaan', [])),
            'pendidikan' => $this->normalizeJsonArray($request->input('pendidikan', [])),
            'agama'      => $this->normalizeJsonArray($request->input('agama', [])),
        ];
    }

    /**
     * Membersihkan array JSON dari nilai kosong
     */
    private function normalizeJsonArray(array $data): array
    {
        return array_filter($data, fn($v) =>
            $v !== null && $v !== '' && $v !== []
        );
    }
}
