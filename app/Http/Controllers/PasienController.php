<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with('user')->get(); // pastikan relasi user dimuat
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'no_rm'    => 'required|unique:pasiens,no_rm',
            'alamat'   => 'nullable|string|max:255',
            'no_ktp'   => 'nullable|string|max:20',
            'no_hp'    => 'nullable|string|max:20',
        ]);

        // Buat akun user terlebih dahulu
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pasien', // Jika masih pakai role
        ]);

        // Buat data pasien dan hubungkan ke user_id
        Pasien::create([
            'user_id' => $user->id,
            'no_rm'   => $request->no_rm,
            'alamat'  => $request->alamat,
            'no_ktp'  => $request->no_ktp,
            'no_hp'   => $request->no_hp,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien dan akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);
        $user   = $pasien->user;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'no_rm'    => 'required|unique:pasiens,no_rm,' . $pasien->id,
            'alamat'   => 'nullable|string|max:255',
            'no_ktp'   => 'nullable|string|max:20',
            'no_hp'    => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user data
        $user->name  = $request->name;
        $user->email = $request->email;

        // Jika password diisi, hash dan simpan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update data pasien
        $pasien->update([
            'no_rm'  => $request->no_rm,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp'  => $request->no_hp,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);

        // Hapus user terkait
        if ($pasien->user) {
            $pasien->user->delete();
        }

        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien dan akun berhasil dihapus.');
    }

    public function show($id)
        {
            $pasien = \App\Models\Pasien::with('user')->findOrFail($id);
            return view('admin.pasien.show', compact('pasien'));
        }

        public function profile()
    {
        $pasien = \App\Models\Pasien::with('user')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('pasien.profile.index', compact('pasien'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $pasien = $user->pasien;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'alamat'   => 'nullable|string|max:255',
            'no_hp'    => 'nullable|string|max:20',
            'no_ktp'   => 'nullable|string|max:30',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->hasFile('photo')) {
            if ($pasien->photo && Storage::disk('public')->exists($pasien->photo)) {
                Storage::disk('public')->delete($pasien->photo);
            }
            $pasien->photo = $request->file('photo')->store('pasien_photos', 'public');
        }

        $pasien->update([
            'alamat' => $request->alamat,
            'no_hp'  => $request->no_hp,
            'no_ktp' => $request->no_ktp,
        ]);

        return back()->with('success', 'Profil pasien berhasil diperbarui.');
    }

}
