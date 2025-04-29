<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'id_kategori',
        'deskripsi',
    ];

    public function Kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function stok()
{
    return $this->hasOne(StokBarang::class, 'id_barang');
}

}
