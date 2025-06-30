<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use App\Models\Obat;
use App\Models\Dokter;
use App\Models\JadwalDokter; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeriksaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'dokter') {
            $listPeriksa = Periksa::with(['pasien', 'obats'])
                ->where('dokter_id', $user->id)
                ->where('status', 'belum')
                ->orderBy('tgl_periksa', 'desc')
                ->get();

            return view('dokter.periksa.index', compact('listPeriksa'));

        } elseif ($user->role === 'pasien') {
            $dokterList = Dokter::with(['user', 'poli'])->get();

            $jadwalData = \App\Models\JadwalDokter::all()->groupBy('dokter_id');
            $jadwalPraktik = [];

            foreach ($jadwalData as $dokterId => $jadwals) {
                $jadwalPraktik[$dokterId] = $jadwals->map(function ($j) {
                    return [
                        'tanggal' => $j->tanggal,
                        'jam' => $j->jam
                    ];
                });
            }

            return view('pasien.periksa.index', compact('dokterList', 'jadwalPraktik'));
        }

        elseif ($user->role === 'admin') {
            $listPeriksa = Periksa::with(['pasien', 'dokter'])->latest()->get();
            return view('admin.poli.index', compact('listPeriksa'));
        }

        abort(403, 'Role tidak dikenali');
    }

    public function create()
    {
        $dokterList = Dokter::with(['user', 'poli'])->get();

        // Perbaikan: Konversi ke array agar bisa digunakan di JS
        $jadwalPraktik = JadwalDokter::all()
            ->groupBy('dokter_id')
            ->map(function ($jadwals) {
                return $jadwals->map(function ($j) {
                    return [
                        'tanggal' => $j->tanggal,
                        'jam' => $j->jam,
                    ];
                });
            })
            ->toArray(); // <<< penting agar bisa diubah ke JSON

        return view('pasien.periksa.create', compact('dokterList', 'jadwalPraktik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'catatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        Periksa::create([
            'id_pasien' => auth()->id(),
            'dokter_id' => $request->dokter_id,
            'tgl_periksa' => Carbon::parse($request->tanggal),
            'catatan' => $request->catatan,
            'biaya_periksa' => 0,
            'status' => 'belum',
        ]);

        return redirect()->route('pasien.periksa.index')->with('success', 'Data periksa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periksa = Periksa::with('obats')->findOrFail($id);
        $dokterList = User::where('role', 'dokter')->get();
        $obatList = Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'dokterList', 'obatList'));
    }

    public function update(Request $request, $id)
    {
        $periksa = Periksa::findOrFail($id);

        $request->validate([
            'obat_id' => 'nullable|array',
            'obat_id.*' => 'exists:obats,id',
            'biaya_periksa' => 'nullable|numeric',
        ]);

        $periksa->update([
            'biaya_periksa' => $request->biaya_periksa ?? 0,
        ]);

        // Sinkronisasi obat
        $periksa->obats()->sync($request->obat_id ?? []);

        return redirect()->route('dokter.periksa.index')->with('success', 'Data periksa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $periksa = Periksa::findOrFail($id);
        $periksa->delete();

        return redirect()->route('dokter.periksa.index')->with('success', 'Data periksa berhasil dihapus.');
    }

    public function riwayat()
    {
        $riwayatPeriksa = Periksa::with('dokter')
            ->where('id_pasien', auth()->id())
            ->where('status', 'selesai')
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('pasien.riwayat.index', compact('riwayatPeriksa'));
    }

    public function riwayatDokter()
    {
        $listPeriksa = Periksa::with(['pasien', 'obats'])
            ->where('dokter_id', auth()->id())
            ->where('status', 'selesai')
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('dokter.riwayat.index', compact('listPeriksa'));
    }

    public function selesai($id)
    {
        $periksa = \App\Models\Periksa::with('obats')->findOrFail($id);

        // Validasi: harus sudah ada obat
        if ($periksa->obats->isEmpty()) {
            return redirect()->back()->with('error', 'Pasien harus diberi obat sebelum periksa dapat diselesaikan.');
        }

        // Validasi: biaya periksa harus lebih dari 0
        if ($periksa->biaya_periksa == 0 || $periksa->biaya_periksa === null) {
            return redirect()->back()->with('error', 'Biaya periksa harus diisi sebelum periksa diselesaikan.');
        }

        // Jika valid, ubah status jadi selesai
        $periksa->status = 'selesai';
        $periksa->save();

        return redirect()->route('dokter.periksa.index')->with('success', 'Periksa telah diselesaikan dan masuk ke riwayat.');
    }

    
    public function jadwal()
    {
        $dokterId = auth()->id();

        $jadwalPeriksa = Periksa::with('pasien')
            ->where('dokter_id', $dokterId)
            ->whereDate('tgl_periksa', '>=', now()->toDateString()) // Tampilkan jadwal hari ini & mendatang
            ->orderBy('tgl_periksa')
            ->get();

        return view('dokter.jadwal.index', compact('jadwalPeriksa'));
    }

    public function showRiwayat($id)
    {
        $periksa = \App\Models\Periksa::with(['dokter', 'obats'])
            ->where('id', $id)
            ->where('id_pasien', auth()->id()) // agar pasien hanya lihat miliknya
            ->firstOrFail();

        return view('pasien.riwayat.show', compact('periksa'));
    }


}
