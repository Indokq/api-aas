<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class KategoriApiController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return response()->json([
            'success' => true,
            'data' => $kategoris
        ]);
    }
}
