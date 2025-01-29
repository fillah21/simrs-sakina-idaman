<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class GetAllKabupatenController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $kabupatenQuery = Kabupaten::query();

        $kabupatenQuery->where('provinsi_id', $request->provinsi_id);
        
        if ($keyword) {
            $kabupatenQuery->whereRaw('LOWER(nama_kabupaten) LIKE ?', ['%' . strtolower($keyword) . '%'])
                           ->orWhereRaw('LOWER(tipe_kabupaten) LIKE ?', ['%' . strtolower($keyword) . '%']);

        }
        
        $kabupaten = $kabupatenQuery->limit(20)->get();

        return response()->json($kabupaten);
    }
}
