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
        'jumlah'
    ];

    public function Kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
