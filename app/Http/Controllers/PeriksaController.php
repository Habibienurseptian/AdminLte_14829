<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'dokter') {
            $listPeriksa = Periksa::with('pasien')
                ->where('dokter_id', auth()->id())
                ->orderBy('tgl_periksa', 'desc')
                ->get();

            return view('dokter.periksa.index', compact('listPeriksa'));

        } elseif (auth()->user()->role === 'pasien') {
            $dokterList = User::where('role', 'dokter')->get();
            return view('pasien.periksa.index', compact('dokterList'));
        }

        abort(403, 'Role tidak dikenali');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokterList = User::where('role', 'dokter')->get();
        return view('pasien.periksa.index', compact('dokterList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'keluhan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $pasien = auth()->user();
        $tanggal = Carbon::parse($request->tanggal);

        Periksa::create([
            'id_pasien' => $pasien->id,
            'dokter_id' => $request->dokter_id,
            'tgl_periksa' => $request->tanggal,
            'catatan' => $request->keluhan,
            'biaya_periksa' => 0,
        ]);

        return redirect()->route('pasien.periksa.index')->with('success', 'Data periksa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periksa $periksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periksa = Periksa::findOrFail($id);
        $dokterList = User::where('role', 'dokter')->get();
        $obatList = \App\Models\Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'dokterList', 'obatList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'keluhan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'dokter_id' => $request->dokter_id,
            'tgl_periksa' => $request->tanggal,
            'catatan' => $request->keluhan,
            'biaya_periksa' => $request->biaya_periksa ?? $periksa->biaya_periksa,
        ]);

        $periksa->obats()->sync($request->obat_id); 

        return redirect()->route('dokter.periksa.index')->with('success', 'Data periksa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periksa = Periksa::findOrFail($id);
        $periksa->delete();

        return redirect()->route('dokter.periksa.index')->with('success', 'Data periksa berhasil dihapus.');
    }

    public function riwayat()
    {
        // Ambil data pemeriksaan pasien yang sedang login
        $riwayatPeriksa = Periksa::with('dokter')
            ->where('id_pasien', auth()->id())
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        return view('pasien.riwayat.index', compact('riwayatPeriksa'));
    }
}
