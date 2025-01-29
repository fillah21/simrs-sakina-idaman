<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;

class GetAllAgamaController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $agamaQuery = Agama::query();

        if ($keyword) {
            $agamaQuery->whereRaw('LOWER(agama) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $agama = $agamaQuery->limit(20)->get();

        return response()->json($agama);
    }
}
