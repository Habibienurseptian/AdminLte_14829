<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Kemana user diarahkan setelah login sukses.
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
     * Custom credentials untuk login dengan role.
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        // Jika role dikirim dari form, tambahkan ke pencarian
        if ($request->has('role')) {
            $credentials['role'] = $request->input('role');
        }

        return $credentials;
    }

    /**
     * Pesan yang dikembalikan jika login gagal.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => __('Login gagal. Email, password, atau peran (role) salah.')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
