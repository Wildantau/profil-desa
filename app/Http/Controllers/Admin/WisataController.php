<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    /* ===============================
     | INDEX
     =============================== */
    public function index()
    {
        $data = Wisata::orderBy('created_at', 'desc')->get();
        return view('admin.wisata.index', compact('data'));
    }

    /* ===============================
     | CREATE
     =============================== */
    public function create()
    {
        return view('admin.wisata.create');
    }

    /* ===============================
     | STORE (FIX validation.in)
     =============================== */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'lokasi'    => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:publik,draft',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('wisata', 'public');
        }

        Wisata::create($validated);

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Data wisata berhasil ditambahkan.');
    }

    /* ===============================
     | EDIT
     =============================== */
    public function edit(Wisata $wisata)
    {
        return view('admin.wisata.edit', compact('wisata'));
    }

    /* ===============================
     | UPDATE (FIX validation.in)
     =============================== */
    public function update(Request $request, Wisata $wisata)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'lokasi'    => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:publik,draft',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($wisata->foto && Storage::disk('public')->exists($wisata->foto)) {
                Storage::disk('public')->delete($wisata->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('wisata', 'public');
        }

        $wisata->update($validated);

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Data wisata berhasil diperbarui.');
    }

    /* ===============================
     | DESTROY (AMAN)
     =============================== */
    public function destroy(Wisata $wisata)
    {
        if ($wisata->foto && Storage::disk('public')->exists($wisata->foto)) {
            Storage::disk('public')->delete($wisata->foto);
        }

        $wisata->delete();

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Data wisata berhasil dihapus.');
    }
}
