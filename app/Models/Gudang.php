<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudangs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}

