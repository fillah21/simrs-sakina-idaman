<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class GetAllTindakanController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $tindakanQuery = Tindakan::query();

        $tindakanQuery->where('layanan_id', $request->layanan_id);

        if ($keyword) {
            $tindakanQuery->whereRaw('LOWER(nama_tindakan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $tindakan = $tindakanQuery->limit(20)->get();

        return response()->json($tindakan);
    }
}
