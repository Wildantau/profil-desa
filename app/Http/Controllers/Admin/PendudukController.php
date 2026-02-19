<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /* ===============================
       INDEX — LAPORAN
       =============================== */
    public function index()
    {
        $rows = Penduduk::orderBy('nama', 'asc')->paginate(10);

        $statistik = Penduduk::selectRaw("
            COUNT(*) AS total,
            SUM(CASE WHEN jk = 'L' THEN 1 ELSE 0 END) AS laki,
            SUM(CASE WHEN jk = 'P' THEN 1 ELSE 0 END) AS perempuan,
            SUM(CASE WHEN aktif = 1 THEN 1 ELSE 0 END) AS aktif,
            SUM(CASE WHEN aktif = 0 THEN 1 ELSE 0 END) AS nonaktif
        ")->first();

        return view('admin.penduduk.index', compact('rows', 'statistik'));
    }

    /* ===============================
       CREATE
       =============================== */
    public function create()
    {
        return view('admin.penduduk.create', [
            'dusunOptions' => [
                'sawiru_kaler' => 'Sawiru Kaler',
                'sawiru_kidul' => 'Sawiru Kidul',
            ]
        ]);
    }

    /* ===============================
       STORE
       =============================== */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:120',
            'nik'    => 'nullable|string|max:32',
            'jk'     => 'required|in:L,P',
            'dusun'  => 'required|string|max:120',
            'rt'     => 'nullable|string|max:10',
            'rw'     => 'nullable|string|max:10',
            'alamat' => 'nullable|string|max:180',
        ]);

        // ✅ checkbox aman
        $data['aktif'] = $request->has('aktif');

        Penduduk::create($data);

        return redirect()
            ->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    /* ===============================
       EDIT
       =============================== */
    public function edit(Penduduk $penduduk)
    {
        return view('admin.penduduk.edit', compact('penduduk'));
    }

    /* ===============================
       UPDATE
       =============================== */
    public function update(Request $request, Penduduk $penduduk)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:120',
            'nik'    => 'nullable|string|max:32',
            'jk'     => 'required|in:L,P',
            'dusun'  => 'required|string|max:120',
            'rt'     => 'nullable|string|max:10',
            'rw'     => 'nullable|string|max:10',
            'alamat' => 'nullable|string|max:180',
        ]);

        $data['aktif'] = $request->has('aktif');

        $penduduk->update($data);

        return redirect()
            ->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    /* ===============================
       DESTROY
       =============================== */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return back()->with('success', 'Data penduduk berhasil dihapus.');
    }
}
