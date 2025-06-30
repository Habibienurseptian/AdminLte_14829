<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\Poli; // Tambahkan ini

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin');
        } elseif ($user->role === 'dokter') {
            return redirect()->route('dokter');
        } elseif ($user->role === 'pasien') {
            return redirect()->route('pasien');
        } else {
            abort(403, 'Kamu tidak dapat mengakses halaman ini');
        }
    }

    public function admin()
    {
        $jumlahPasien = User::where('role', 'pasien')->count();
        $jumlahDokter = User::where('role', 'dokter')->count();
        $jumlahObat   = Obat::count();
        $jumlahPoli   = Poli::count();
        $jumlahUser   = User::count();
        $uniqueVisitors = 65; // Contoh data

        return view('admin.index', compact(
            'jumlahPasien',
            'jumlahDokter',
            'jumlahObat',
            'jumlahPoli',
            'jumlahUser',
            'uniqueVisitors'
        ));
    }

    public function dokter()
    {
        $dokterId = auth()->id();

        $jumlahPeriksa         = Periksa::where('dokter_id', $dokterId)->count();
        $jumlahPeriksaSelesai  = Periksa::where('dokter_id', $dokterId)->where('status', 'selesai')->count();
        $jumlahPeriksaBelum    = Periksa::where('dokter_id', $dokterId)->where('status', 'belum')->count();

        return view('dokter.index', compact(
            'jumlahPeriksa',
            'jumlahPeriksaSelesai',
            'jumlahPeriksaBelum'
        ));
    }

    public function pasien()
    {
        $pasienId = auth()->id();

        $jumlahPeriksa = Periksa::where('id_pasien', $pasienId)->count();

        return view('pasien.index', compact('jumlahPeriksa'));
    }
}
