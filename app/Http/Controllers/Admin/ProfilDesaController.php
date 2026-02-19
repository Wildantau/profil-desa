<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\ProfilDesa;

class ProfilDesaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit()
    {
        $profil = ProfilDesa::firstOrCreate(
            ['id' => 1],
            [
                'nama_desa' => 'Nama Desa',
                'aktif' => true,
            ]
        );

        return view('admin.profil-desa.edit', compact('profil'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        $validated = $request->validate([

            'nama_desa' => ['required','string','max:120'],
            'kecamatan' => ['required','string','max:120'],
            'kabupaten' => ['required','string','max:120'],
            'provinsi'  => ['required','string','max:120'],
            'kode_pos'  => ['nullable','string','max:10'],

            // RPJMDes
            'rpjmdes_file'  => ['nullable','mimes:pdf','max:5120'],
            'hapus_rpjmdes' => ['nullable','in:1'],

            // RKPDes
            'rkpdes_file'   => ['nullable','mimes:pdf','max:5120'],
            'hapus_rkpdes'  => ['nullable','in:1'],

            'aktif' => ['nullable','in:1'],
        ]);

        $profil = ProfilDesa::firstOrNew(['id' => 1]);

        /*
        |--------------------------------------------------------------------------
        | RPJMDes
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('rpjmdes_file')) {

            $this->deleteFile($profil->rpjmdes_file);

            $profil->rpjmdes_file = $this->storeDocument(
                $request->file('rpjmdes_file'),
                'rpjmdes'
            );
        }

        if ($request->boolean('hapus_rpjmdes')) {
            $this->deleteFile($profil->rpjmdes_file);
            $profil->rpjmdes_file = null;
        }

        /*
        |--------------------------------------------------------------------------
        | RKPDes
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('rkpdes_file')) {

            $this->deleteFile($profil->rkpdes_file);

            $profil->rkpdes_file = $this->storeDocument(
                $request->file('rkpdes_file'),
                'rkpdes'
            );
        }

        if ($request->boolean('hapus_rkpdes')) {
            $this->deleteFile($profil->rkpdes_file);
            $profil->rkpdes_file = null;
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE DATA
        |--------------------------------------------------------------------------
        */
        $profil->fill([
            'nama_desa' => $validated['nama_desa'],
            'kecamatan' => $validated['kecamatan'],
            'kabupaten' => $validated['kabupaten'],
            'provinsi'  => $validated['provinsi'],
            'kode_pos'  => $validated['kode_pos'] ?? null,
            'aktif'     => $request->boolean('aktif'),
        ]);

        $profil->save();

        return back()->with('success', 'Dokumen berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE DOCUMENT
    |--------------------------------------------------------------------------
    */
    private function storeDocument($file, string $prefix): string
    {
        $dir = public_path('dokumen/profil');

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $name = $prefix . '-' . now()->format('YmdHis') . '-' . Str::random(5) . '.pdf';

        $file->move($dir, $name);

        return 'dokumen/profil/' . $name;
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE FILE
    |--------------------------------------------------------------------------
    */
    private function deleteFile(?string $path): void
    {
        if (!$path) return;

        $full = public_path($path);

        if (File::exists($full)) {
            @File::delete($full);
        }
    }
}
