<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $kategori = trim((string) $request->get('kategori', ''));
        $aktif = $request->get('aktif', ''); // '', '1', '0'

        $rows = PerangkatDesa::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('jabatan', 'like', "%{$q}%")
                      ->orWhere('nama', 'like', "%{$q}%");
                });
            })
            ->when($kategori !== '', function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            })
            ->when($aktif !== '' && in_array($aktif, ['0', '1'], true), function ($query) use ($aktif) {
                $query->where('aktif', (int) $aktif);
            })
            ->orderBy('kategori')
            ->orderBy('urutan')
            ->paginate(20)
            ->withQueryString();

        $kategoriOptions = [
            'kepala_desa' => 'Kepala Desa',
            'sekretaris'  => 'Sekretaris Desa',
            'kasi'        => 'Kepala Seksi (KASI)',
            'kaur'        => 'Kepala Urusan (KAUR)',
            'dusun'       => 'Kepala Dusun',
        ];

        return view('admin.perangkat-desa.index', compact('rows', 'q', 'kategori', 'aktif', 'kategoriOptions'));
    }

    public function create()
    {
        $kategoriOptions = [
            'kepala_desa' => 'Kepala Desa',
            'sekretaris'  => 'Sekretaris Desa',
            'kasi'        => 'Kepala Seksi (KASI)',
            'kaur'        => 'Kepala Urusan (KAUR)',
            'dusun'       => 'Kepala Dusun',
        ];

        $defaultUrutan = (int) (PerangkatDesa::max('urutan') ?? 0) + 10;

        return view('admin.perangkat-desa.create', compact('kategoriOptions', 'defaultUrutan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'   => 'required|in:kepala_desa,sekretaris,kasi,kaur,dusun',
            'jabatan'    => 'required|string|max:120',
            'nama'       => 'nullable|string|max:120',

            // path manual / URL (string)
            'foto'       => 'nullable|string|max:255',

            // upload file
            'foto_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'urutan'     => 'required|integer|min:0|max:9999',
            'aktif'      => 'nullable|boolean',
        ]);

        $validated['aktif'] = (bool) $request->boolean('aktif');

        // nama default
        $validated['nama'] = trim((string) ($validated['nama'] ?? ''));
        if ($validated['nama'] === '') $validated['nama'] = '_____';

        // normalize foto string
        $validated['foto'] = isset($validated['foto']) ? trim((string) $validated['foto']) : null;
        if ($validated['foto'] === '') $validated['foto'] = null;

        // UPLOAD FOTO (prioritas)
        if ($request->hasFile('foto_file')) {
            $file = $request->file('foto_file');

            $destinationDir = public_path('images/pemerintahan');
            if (!File::exists($destinationDir)) {
                File::makeDirectory($destinationDir, 0755, true);
            }

            $safeKategori = Str::slug($validated['kategori']);
            $safeJabatan  = Str::slug($validated['jabatan']);
            $safeNama     = Str::slug($validated['nama'] !== '_____' ? $validated['nama'] : 'perangkat');
            $ext          = strtolower($file->getClientOriginalExtension());

            $filename = $safeKategori . '-' . $safeJabatan . '-' . $safeNama . '-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $ext;

            $file->move($destinationDir, $filename);

            $validated['foto'] = 'images/pemerintahan/' . $filename;
        }

        unset($validated['foto_file']);

        PerangkatDesa::create($validated);

        return redirect()
            ->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil ditambahkan.');
    }

    public function show(PerangkatDesa $perangkat_desa)
    {
        return view('admin.perangkat-desa.show', [
            'item' => $perangkat_desa,
        ]);
    }

    public function edit(PerangkatDesa $perangkat_desa)
    {
        $kategoriOptions = [
            'kepala_desa' => 'Kepala Desa',
            'sekretaris'  => 'Sekretaris Desa',
            'kasi'        => 'Kepala Seksi (KASI)',
            'kaur'        => 'Kepala Urusan (KAUR)',
            'dusun'       => 'Kepala Dusun',
        ];

        return view('admin.perangkat-desa.edit', [
            'item' => $perangkat_desa,
            'kategoriOptions' => $kategoriOptions,
        ]);
    }

    public function update(Request $request, PerangkatDesa $perangkat_desa)
    {
        $validated = $request->validate([
            'kategori'   => 'required|in:kepala_desa,sekretaris,kasi,kaur,dusun',
            'jabatan'    => 'required|string|max:120',
            'nama'       => 'nullable|string|max:120',

            // path manual / URL (string)
            'foto'       => 'nullable|string|max:255',

            // upload file
            'foto_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // checkbox hapus foto
            'hapus_foto' => 'nullable|boolean',

            'urutan'     => 'required|integer|min:0|max:9999',
            'aktif'      => 'nullable|boolean',
        ]);

        $validated['aktif'] = (bool) $request->boolean('aktif');

        // nama default
        $validated['nama'] = trim((string) ($validated['nama'] ?? ''));
        if ($validated['nama'] === '') $validated['nama'] = '_____';

        // normalize foto string (penting: kosong jadi null)
        $validated['foto'] = isset($validated['foto']) ? trim((string) $validated['foto']) : null;
        if ($validated['foto'] === '') $validated['foto'] = null;

        $hapusFoto = (bool) $request->boolean('hapus_foto');

        // helper: hapus file foto lama jika managed lokal
        $deleteOldManaged = function () use ($perangkat_desa) {
            $oldFoto = $perangkat_desa->foto;
            if (!$oldFoto || !is_string($oldFoto)) return;

            $oldFotoNorm = str_replace('\\', '/', $oldFoto);
            $isLocalManaged =
                Str::startsWith($oldFotoNorm, 'images/pemerintahan/')
                && !Str::contains($oldFotoNorm, ['..', '://']);

            if ($isLocalManaged) {
                $oldPath = public_path($oldFotoNorm);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
        };

        // 1) kalau UPLOAD FOTO: replace + hapus foto lama (managed)
        if ($request->hasFile('foto_file')) {
            $file = $request->file('foto_file');

            $destinationDir = public_path('images/pemerintahan');
            if (!File::exists($destinationDir)) {
                File::makeDirectory($destinationDir, 0755, true);
            }

            $deleteOldManaged();

            $safeKategori = Str::slug($validated['kategori']);
            $safeJabatan  = Str::slug($validated['jabatan']);
            $safeNama     = Str::slug($validated['nama'] !== '_____' ? $validated['nama'] : 'perangkat');
            $ext          = strtolower($file->getClientOriginalExtension());

            $filename = $safeKategori . '-' . $safeJabatan . '-' . $safeNama . '-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $ext;

            $file->move($destinationDir, $filename);

            $validated['foto'] = 'images/pemerintahan/' . $filename;
        }
        // 2) tidak upload & centang hapus foto
        elseif ($hapusFoto) {
            $deleteOldManaged();
            $validated['foto'] = null;
        }
        // 3) tidak upload & tidak hapus: path manual
        else {
            // kalau user tidak isi apa-apa (null) => jangan timpa foto lama
            if ($validated['foto'] === null) {
                unset($validated['foto']);
            }
            // kalau user isi path/url => update dengan nilai itu (sudah trim)
        }

        unset($validated['foto_file'], $validated['hapus_foto']);

        $perangkat_desa->update($validated);

        return redirect()
            ->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil diperbarui.');
    }

    public function destroy(PerangkatDesa $perangkat_desa)
    {
        $oldFoto = $perangkat_desa->foto;
        if ($oldFoto && is_string($oldFoto)) {
            $oldFotoNorm = str_replace('\\', '/', $oldFoto);

            $isLocalManaged =
                Str::startsWith($oldFotoNorm, 'images/pemerintahan/')
                && !Str::contains($oldFotoNorm, ['..', '://']);

            if ($isLocalManaged) {
                $path = public_path($oldFotoNorm);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }

        $perangkat_desa->delete();

        return redirect()
            ->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil dihapus.');
    }
}
