<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index()
    {
        $data = Umkm::orderBy('created_at', 'desc')->get();
        return view('admin.umkm.index', compact('data'));
    }

    public function create()
    {
        return view('admin.umkm.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pelaku'     => 'required|string|max:255',
            'kategori'   => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'status'     => 'required|in:publik,draft',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        Umkm::create($data);

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil ditambahkan');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $data = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pelaku'     => 'required|string|max:255',
            'kategori'   => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'status'     => 'required|in:publik,draft',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($umkm->foto && Storage::disk('public')->exists($umkm->foto)) {
                Storage::disk('public')->delete($umkm->foto);
            }

            $data['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update($data);

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil diperbarui');
    }

    public function destroy(Umkm $umkm)
    {
        if ($umkm->foto && Storage::disk('public')->exists($umkm->foto)) {
            Storage::disk('public')->delete($umkm->foto);
        }

        $umkm->delete();

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil dihapus');
    }
}
