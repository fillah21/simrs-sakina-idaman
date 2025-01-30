<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetPasienLamaController extends Controller
{
    public function __invoke(Request $request)
    {
        $pasien = Pasien::find($request->pasien_id);

        $pasien->tanggal_lahir = Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y');

        return response()->json($pasien);
    }
}
