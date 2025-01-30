<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class GetAllLayananController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $layananQuery = Layanan::query();

        $layananQuery->where('instalasi_id', $request->instalasi_id);

        if ($keyword) {
            $layananQuery->whereRaw('LOWER(nama_layanan) LIKE ?', ['%' . strtolower($keyword) . '%'])
                        ->orWhereRaw('LOWER(kode_layanan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $layanan = $layananQuery->limit(20)->get();

        return response()->json($layanan);
    }
}
