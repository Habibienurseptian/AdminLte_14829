<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirect user to their respective dashboard after login.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'dokter') {
            return redirect()->route('dokter');
        } elseif ($user->role == 'pasien') {
            return redirect()->route('pasien');
        } else {
            abort(403, 'Kamu tidak dapat mengakses halaman ini');
        }
    }

    /**
     * Halaman dashboard untuk dokter.
     */
    public function dokter()
    {
        return view('dokter.index');
    }

    /**
     * Halaman dashboard untuk pasien.
     */
    public function pasien()
    {
        return view('pasien.index');
    }
}
