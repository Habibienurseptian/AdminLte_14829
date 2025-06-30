<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\Pasien;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPraktikController extends Controller
{
    public function index()
    {
        $dokterId = auth()->id();

        $jadwalList = JadwalDokter::where('dokter_id', $dokterId)
                        ->orderBy('tanggal', 'asc')
                        ->get();

        return view('dokter.jadwal.index', compact('jadwalList'));
    }

    public function create()
    {
        $pasiens = \App\Models\Pasien::with('user')->get();
        return view('dokter.jadwal.create', compact('pasiens'));
    }

   // JadwalPraktik

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);

        JadwalDokter::create([
            'dokter_id' => Auth::id(),
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ]);

        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal praktik berhasil disimpan');
    }

    public function edit($id)
    {
        $jadwal = \App\Models\JadwalDokter::findOrFail($id);

        if ($jadwal->dokter_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit jadwal ini.');
        }

        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    public function destroy($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);

        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->update([
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ]);

        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }
    
}
