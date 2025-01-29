<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class GetAllProvinsiController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $provinsiQuery = Provinsi::query();

        if ($keyword) {
            $provinsiQuery->whereRaw('LOWER(nama_provinsi) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $provinsi = $provinsiQuery->get();

        return response()->json($provinsi);
    }
}
