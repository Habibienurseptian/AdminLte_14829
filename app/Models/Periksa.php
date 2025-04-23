<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $fillable = ['id_pasien', 'dokter_id', 'tgl_periksa', 'catatan', 'biaya_periksa'];

    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'periksa_obat');
    }

    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'periksa_obat', 'periksa_id', 'obat_id');
    }
}

