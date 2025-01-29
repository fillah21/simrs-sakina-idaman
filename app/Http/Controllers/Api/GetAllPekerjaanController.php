<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class GetAllPekerjaanController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $pekerjaanQuery = Pekerjaan::query();

        if ($keyword) {
            $pekerjaanQuery->whereRaw('LOWER(nama_pekerjaan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $pekerjaan = $pekerjaanQuery->get();

        return response()->json($pekerjaan);
    }
}
