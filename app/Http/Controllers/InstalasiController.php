<?php

namespace App\Http\Controllers;

use App\DataTables\InstalasiDataTable;
use App\Http\Requests\InstalasiRequest;
use App\Models\Instalasi;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InstalasiDataTable $dataTable)
    {
        $title = "Instalasi";

        return $dataTable->render('instalasi.index', compact('title'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instalasi = new Instalasi();

        return view('instalasi.form', compact('instalasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstalasiRequest $request)
    {
        $data = $request->validated();
        $data['kode_instalasi'] = generateKodeInstalasi();

        if($data['is_antrian'] == "1") {
            $data['is_antrian'] = true;
        } else {
            $data['is_antrian'] = false;
        }

        Instalasi::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Instalasi Berhasil Ditambahkan'
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
        $instalasi = Instalasi::find($id);

        return view('instalasi.form', compact('instalasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstalasiRequest $request, string $id)
    {
        $data = $request->validated();

        if($data['is_antrian'] == "1") {
            $data['is_antrian'] = true;
        } else {
            $data['is_antrian'] = false;
        }
        
        $instalasi = Instalasi::find($id);

        $instalasi->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Instalasi Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instalasi = Instalasi::find($id);

        $instalasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Instalasi Berhasil Dihapus'
        ]);
    }
}
