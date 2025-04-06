<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use Illuminate\Http\Request;
use App\Models\User;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'dokter') {
            return view('dokter.periksa.index');
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
        //
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
    public function edit(Periksa $periksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periksa $periksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periksa $periksa)
    {
        //
    }
}
