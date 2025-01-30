<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetAllPasienController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $pasienQuery = Pasien::query();

        if ($keyword) {
            $pasienQuery->whereRaw('LOWER(nama_pasien) LIKE ?', ['%' . strtolower($keyword) . '%'])
                        ->orWhereRaw('LOWER(nik) LIKE ?', ['%' . strtolower($keyword) . '%'])
                        ->orWhereRaw("DATE_FORMAT(tanggal_lahir, '%d/%m/%Y') LIKE ?", ['%' . $keyword . '%']);
        }

        $pasien = $pasienQuery->limit(20)->get()->map(function ($item) {
            $item->tanggal_lahir = Carbon::parse($item->tanggal_lahir)->format('d/m/Y');
            return $item;
        });

        return response()->json($pasien);
    }
}
