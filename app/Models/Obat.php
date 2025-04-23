<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = ['nama_obat', 'kemasan', 'harga'];
    
    public function periksas()
    {
        return $this->belongsToMany(Periksa::class, 'periksa_obat', 'obat_id', 'periksa_id');
    }
}
