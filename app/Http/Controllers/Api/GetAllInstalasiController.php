<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instalasi;
use Illuminate\Http\Request;

class GetAllInstalasiController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $instalasiQuery = Instalasi::query();

        if ($keyword) {
            $instalasiQuery->whereRaw('LOWER(nama_instalasi) LIKE ?', ['%' . strtolower($keyword) . '%'])
                        ->orWhereRaw('LOWER(kode_instalasi) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $instalasi = $instalasiQuery->limit(20)->get();

        return response()->json($instalasi);
    }
}
