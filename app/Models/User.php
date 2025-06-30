<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Jika kamu menggunakan Laravel 10 ke atas, tambahkan:
    // protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // pastikan kolom ini ada jika kamu menggunakan role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pasien()
    {
        return $this->hasOne(Pasien::class);
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class);
    }
}
