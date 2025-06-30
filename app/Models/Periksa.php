<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    // Jika nama tabel bukan 'periksas', sesuaikan dengan nama tabel sebenarnya
    // Misal: protected $table = 'periksa';
    protected $table = 'periksas';

    protected $fillable = [
        'id_pasien',
        'dokter_id',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'status'
    ];

    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];

    // Relasi ke pasien (User)
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    // Relasi ke dokter (User)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    // Relasi ke obat (many-to-many)
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'periksa_obat', 'periksa_id', 'obat_id')
                    ->withTimestamps();
    }

    // Optional accessor agar bisa pakai $periksa->keluhan
    public function getKeluhanAttribute()
    {
        return $this->catatan;
    }
}
