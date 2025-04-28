<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class BarangApiController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();

        return response()->json([
            'success' => true,
            'data' => $barangs
        ]);
    }
}

