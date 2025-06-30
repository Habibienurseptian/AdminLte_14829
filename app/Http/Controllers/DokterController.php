<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with(['user', 'poli'])->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'alamat'   => 'nullable|string|max:255',
            'no_hp'    => 'nullable|string|max:20',
            'poli_id'  => 'required|exists:polis,id',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'dokter',
        ]);

        Dokter::create([
            'user_id' => $user->id,
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'poli_id' => $request->poli_id,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Dokter dan akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        $user = $dokter->user;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'alamat'   => 'nullable|string|max:255',
            'no_hp'    => 'nullable|string|max:20',
            'poli_id'  => 'required|exists:polis,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $dokter->update([
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'poli_id' => $request->poli_id,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($dokter->user) {
            $dokter->user->delete();
        }

        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter dan akun berhasil dihapus.');
    }

    public function profile()
    {
        $dokter = \App\Models\Dokter::with(['user', 'poli'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('dokter.profile.index', compact('dokter'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $dokter = $user->dokter;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'alamat'   => 'nullable|string|max:255', // ← tambahkan validasi ini
            'no_hp'    => 'nullable|string|max:20',   // ← dan ini
        ]);

        // Update user data
        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update data dokter
        $dokter->alamat = $request->alamat;
        $dokter->no_hp = $request->no_hp;

        // Update photo jika ada
        if ($request->hasFile('photo')) {
            if ($dokter->photo && \Storage::disk('public')->exists($dokter->photo)) {
                \Storage::disk('public')->delete($dokter->photo);
            }

            $path = $request->file('photo')->store('dokter_photos', 'public');
            $dokter->photo = $path;
        }

        $dokter->save(); // ← simpan semua perubahan dokter

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
