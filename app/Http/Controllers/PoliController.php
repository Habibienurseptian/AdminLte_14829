<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // Tampilkan semua data poli
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    // Form tambah data poli
    public function create()
    {
        return view('admin.poli.create');
    }

    // Simpan data poli baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255|unique:polis,nama',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        Poli::create($request->only(['nama', 'keterangan']));

        return redirect()->route('poli.index')
                         ->with('success', 'Data poli berhasil ditambahkan.');
    }

    // Form edit data poli
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.poli.edit', compact('poli'));
    }

    // Simpan perubahan data poli
    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:255|unique:polis,nama,' . $poli->id,
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $poli->update($request->only(['nama', 'keterangan']));

        return redirect()->route('poli.index')
                         ->with('success', 'Data poli berhasil diperbarui.');
    }

    // Hapus data poli
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('poli.index')
                         ->with('success', 'Data poli berhasil dihapus.');
    }
}
