<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDataTable;
use App\Http\Requests\PasienRequest;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PasienDataTable $dataTable)
    {
        $title = 'Pasien';

        return $dataTable->render('pasien.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = new Pasien();

        return view('pasien.form', compact('pasien'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasienRequest $request)
    {
        $data = $request->validated();
        $data['no_rm'] = generateNoRM();
        $data['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_lahir'])->format('Y-m-d');

        Pasien::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pasien Berhasil Ditambahkan',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasien = Pasien::where('id', $id)->with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'agama', 'pekerjaan', 'pendidikan'])->first();

        if($pasien->jk == 'L') {
            $pasien->jk = "L|Laki-Laki";
        } else {
            $pasien->jk = "P|Perempuan";
        }

        $pasien->tanggal_lahir = Carbon::createFromFormat('Y-m-d', $pasien->tanggal_lahir)->format('d/m/Y');

        return view('pasien.form', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PasienRequest $request, string $id)
    {
        $data = $request->validated();

        $data['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_lahir'])->format('Y-m-d');

        $pasien = Pasien::find($id);

        $pasien->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pasien Berhasil Diedit',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Pasien::find($id);

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pasien Berhasil Dihapus',
        ], 200);
    }
}
