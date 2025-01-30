<?php

namespace App\Http\Controllers;

use App\DataTables\AgamaDataTable;
use App\Http\Requests\AgamaRequest;
use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AgamaDataTable $dataTable)
    {
        $title = "Agama";

        return $dataTable->render('agama.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agama = new Agama();

        return view('agama.form', compact('agama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgamaRequest $request)
    {
        $data = $request->validated();

        Agama::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Agama Berhasil Ditambahkan'
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
        $agama = Agama::find($id);

        return view('agama.form', compact('agama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgamaRequest $request, string $id)
    {
        $data = $request->validated();

        $agama = Agama::find($id);

        $agama->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Agama Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agama = Agama::find($id);

        $agama->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Agama Berhasil Dihapus'
        ]);
    }
}
