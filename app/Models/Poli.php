<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis'; // Nama tabel di database

    protected $fillable = [
        'nama',
        'keterangan',
    ];
    
    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }
}

