<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class GetAllKelurahanController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $kelurahanQuery = Kelurahan::query();

        $kelurahanQuery->where('kecamatan_id', $request->kecamatan_id);

        if ($keyword) {
            $kelurahanQuery->whereRaw('LOWER(nama_kelurahan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $kelurahan = $kelurahanQuery->limit(20)->get();

        return response()->json($kelurahan);
    }
}
