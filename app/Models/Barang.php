<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok',
        'gudang_id',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
