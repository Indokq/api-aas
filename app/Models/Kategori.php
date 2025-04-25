<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori'
    ];
    
    public function Barang() { 
        return $this->hasMany(Barang::class);
    }
}
