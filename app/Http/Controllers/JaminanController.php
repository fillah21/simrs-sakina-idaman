<?php

namespace App\Http\Controllers;

use App\DataTables\JaminanDataTable;
use App\Http\Requests\JaminanRequest;
use App\Models\Jaminan;
use Illuminate\Http\Request;

class JaminanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(JaminanDataTable $dataTable)
    {
        $title = "Jaminan";

        return $dataTable->render('jaminan.index', compact('title'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jaminan = new Jaminan();

        return view('jaminan.form', compact('jaminan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JaminanRequest $request)
    {
        $data = $request->validated();
        $data['kode_jaminan'] = generateKodeJaminan();

        if($data['wajib_rujukan'] == "1") {
            $data['wajib_rujukan'] = true;
        } else {
            $data['wajib_rujukan'] = false;
        }

        if($data['wajib_keterangan_jaminan'] == "1") {
            $data['wajib_keterangan_jaminan'] = true;
        } else {
            $data['wajib_keterangan_jaminan'] = false;
        }

        Jaminan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Jaminan Berhasil Ditambahkan'
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
        $jaminan = Jaminan::find($id);

        return view('jaminan.form', compact('jaminan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JaminanRequest $request, string $id)
    {
        $data = $request->validated();

        if($data['wajib_rujukan'] == "1") {
            $data['wajib_rujukan'] = true;
        } else {
            $data['wajib_rujukan'] = false;
        }

        if($data['wajib_keterangan_jaminan'] == "1") {
            $data['wajib_keterangan_jaminan'] = true;
        } else {
            $data['wajib_keterangan_jaminan'] = false;
        }

        $jaminan = Jaminan::find($id);

        $jaminan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Jaminan Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instalasi = Jaminan::find($id);

        $instalasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jaminan Berhasil Dihapus'
        ]);
    }
}
