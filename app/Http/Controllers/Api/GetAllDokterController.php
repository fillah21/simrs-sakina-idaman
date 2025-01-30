<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class GetAllDokterController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $dokterQuery = Dokter::query();

        $dokterQuery->where('layanan_id', $request->layanan_id)
                    ->where('is_aktif', true);

        if ($keyword) {
            $dokterQuery->whereRaw('LOWER(nama_dokter) LIKE ?', ['%' . strtolower($keyword) . '%'])
                        ->orWhereRaw('LOWER(sip) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $dokter = $dokterQuery->limit(20)->get();

        return response()->json($dokter);
    }
}
