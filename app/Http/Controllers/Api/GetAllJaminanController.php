<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jaminan;
use Illuminate\Http\Request;

class GetAllJaminanController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $jaminanQuery = Jaminan::query();

        if ($keyword) {
            $jaminanQuery->whereRaw('LOWER(nama_jaminan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $jaminan = $jaminanQuery->limit(20)->get();

        return response()->json($jaminan);
    }
}
