<?php

namespace App\Http\Controllers;

use App\DataTables\PekerjaanDataTable;
use App\Http\Requests\PekerjaanRequest;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PekerjaanDataTable $dataTable)
    {
        $title = "Pekerjaan";

        return $dataTable->render('pekerjaan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pekerjaan = new Pekerjaan();

        return view('pekerjaan.form', compact('pekerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PekerjaanRequest $request)
    {
        $data = $request->validated();
        $data['kode_pekerjaan'] = generateKodePekerjaan();

        Pekerjaan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pekerjaan Berhasil Ditambahkan'
        ]);
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
        $pekerjaan = Pekerjaan::find($id);

        return view('pekerjaan.form', compact('pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PekerjaanRequest $request, string $id)
    {
        $data = $request->validated();

        $pekerjaan = Pekerjaan::find($id);

        $pekerjaan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pekerjaan Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pekerjaan = Pekerjaan::find($id);

        $pekerjaan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pekerjaan Berhasil Dihapus'
        ]);
    }
}
