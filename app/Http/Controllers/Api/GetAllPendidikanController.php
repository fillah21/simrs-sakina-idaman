<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class GetAllPendidikanController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;
        $pendidikanQuery = Pendidikan::query();

        if ($keyword) {
            $pendidikanQuery->whereRaw('LOWER(pendidikan) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }

        $pendidikan = $pendidikanQuery->limit(20)->get();

        return response()->json($pendidikan);
    }
}
