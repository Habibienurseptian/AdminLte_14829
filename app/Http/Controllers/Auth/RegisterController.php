<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Kemana pengguna diarahkan setelah registrasi.
     */
    protected function redirectTo()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => '/admin',
            'dokter' => '/dokter',
            'pasien' => '/pasien',
            default => '/home',
        };
    }

    /**
     * Membuat instance controller baru.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validasi data registrasi.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // Hapus validasi role dari sini
        ]);
    }

    /**
     * Buat user baru setelah registrasi valid.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'admin',
        ]);
    }
}
