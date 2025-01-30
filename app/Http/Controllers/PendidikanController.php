<?php

namespace App\Http\Controllers;

use App\DataTables\PendidikanDataTable;
use App\Http\Requests\PendidikanRequest;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendidikanDataTable $dataTable)
    {
        $title = "Pendidikan";

        return $dataTable->render('pendidikan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pendidikan = new Pendidikan();

        return view('pendidikan.form', compact('pendidikan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendidikanRequest $request)
    {
        $data = $request->validated();

        Pendidikan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendidikan Berhasil Ditambahkan'
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
        $pendidikan = Pendidikan::find($id);

        return view('pendidikan.form', compact('pendidikan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendidikanRequest $request, string $id)
    {
        $data = $request->validated();

        $pendidikan = Pendidikan::find($id);

        $pendidikan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendidikan Berhasil Diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendidikan = Pendidikan::find($id);

        $pendidikan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pendidikan Berhasil Dihapus'
        ]);
    }
}
