<?php

namespace App\Http\Controllers;

use App\DataTables\LayananDataTable;
use App\Http\Requests\LayananRequest;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LayananDataTable $dataTable)
    {
        $title = "Layanan";

        return $dataTable->render('layanan.index', compact('title'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layanan = new Layanan();

        return view('layanan.form', compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LayananRequest $request)
    {
        $data = $request->validated();
        $data['kode_layanan'] = generateKodeLayanan();

        if($data['wajib_rujukan'] == "1") {
            $data['wajib_rujukan'] = true;
        } else {
            $data['wajib_rujukan'] = false;
        }

        Layanan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Layanan Berhasil Ditambahkan'
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
        $layanan = Layanan::where('id', $id)->with(['instalasi'])->first();

        return view('layanan.form', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LayananRequest $request, string $id)
    {
        $data = $request->validated();

        if($data['wajib_rujukan'] == "1") {
            $data['wajib_rujukan'] = true;
        } else {
            $data['wajib_rujukan'] = false;
        }

        $layanan = Layanan::find($id);

        $layanan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Layanan Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::find($id);

        $layanan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Layanan Berhasil Dihapus'
        ]);
    }
}
