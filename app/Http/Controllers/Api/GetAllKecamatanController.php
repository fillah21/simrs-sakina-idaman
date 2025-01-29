<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class GetAllKecamatanController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $kecamatanQuery = Kecamatan::query();

        $kecamatanQuery->where('kabupaten_id', $request->kabupaten_id);

        if ($keyword) {
            $kecamatanQuery->whereRaw('LOWER(nama_kecamatan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $kecamatan = $kecamatanQuery->limit(20)->get();

        return response()->json($kecamatan);
    }
}
