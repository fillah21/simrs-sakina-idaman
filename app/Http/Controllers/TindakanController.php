<?php

namespace App\Http\Controllers;

use App\DataTables\TindakanDataTable;
use App\Http\Requests\TindakanRequest;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TindakanDataTable $dataTable)
    {
        $title = "Tindakan";

        return $dataTable->render('tindakan.index', compact('title'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tindakan = new Tindakan();

        return view('tindakan.form', compact('tindakan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TindakanRequest $request)
    {
        $data = $request->validated();
        $data['kode_tindakan'] = generateKodeTindakan();

        Tindakan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Tindakan Berhasil Ditambahkan'
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
        $tindakan = Tindakan::where('id', $id)->with(['layanan'])->first();

        return view('tindakan.form', compact('tindakan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TindakanRequest $request, string $id)
    {
        $data = $request->validated();

        $tindakan = Tindakan::find($id);

        $tindakan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Tindakan Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tindakan = Tindakan::find($id);

        $tindakan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tindakan Berhasil Dihapus'
        ]);
    }
}
