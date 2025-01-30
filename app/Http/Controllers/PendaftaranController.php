<?php

namespace App\Http\Controllers;

use App\DataTables\PendaftaranDataTable;
use App\Http\Requests\PendaftaranRequest;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendaftaranDataTable $dataTable)
    {
        $title = "Pendaftaran";

        return $dataTable->render('pendaftaran.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Buat Pendaftaran";
        $pendaftaran = new Pendaftaran();

        return view('pendaftaran.form', compact('title', 'pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendaftaranRequest $request)
    {
        $data = $request->validated();

        $data['no_pendaftaran'] = generateNoPendaftaran();
        $data['waktu_kunjungan'] = Carbon::createFromFormat('d/m/Y H:i', $data['waktu_kunjungan'])->format('Y-m-d H:i:s');
        $data['antrian'] = generateNoAntrian($data['layanan_id'], $data['waktu_kunjungan']);

        Pendaftaran::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran Berhasil Dibuat',
            'url' => route('pendaftaran.index')
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
        $title = "Edit Pendaftaran";
        $pendaftaran = Pendaftaran::where('id', $id)->with(['pasien', 'instalasi', 'layanan', 'dokter', 'jaminan', 'tindakan'])->first();

        $pendaftaran->waktu_kunjungan = Carbon::parse($pendaftaran->waktu_kunjungan)->format('d/m/Y H:i');

        $pendaftaran->pasien->tanggal_lahir = Carbon::parse($pendaftaran->pasien->tanggal_lahir)->format('d/m/Y');

        $pendaftaran->wajib_rujukan_layanan = $pendaftaran->layanan->wajib_rujukan;
        $pendaftaran->wajib_rujukan_jaminan = $pendaftaran->jaminan->wajib_rujukan;
        $pendaftaran->wajib_keterangan_jaminan = $pendaftaran->jaminan->wajib_keterangan_jaminan;

        return view('pendaftaran.form', compact('title', 'pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendaftaranRequest $request, string $id)
    {
        $data = $request->validated();

        $tanggal_kunjungan = Carbon::createFromFormat('!d/m/Y', explode(" ", $data['waktu_kunjungan'])[0])->format('Y-m-d');

        $pendaftaran = Pendaftaran::find($id);

        $tanggal_kunjungan_old = Carbon::parse($pendaftaran->waktu_kunjungan)->format('Y-m-d');

        if($tanggal_kunjungan != $tanggal_kunjungan_old || $data['layanan_id'] != $pendaftaran->layanan_id) {
            $data['antrian'] = generateNoAntrian($data['layanan_id'], $data['waktu_kunjungan']);
        }

        $data['waktu_kunjungan'] = Carbon::createFromFormat('!d/m/Y H:i', $data['waktu_kunjungan'])->format('Y-m-d H:i:s');

        $pendaftaran->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran Berhasil Diubah',
            'url' => route('pendaftaran.index')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::find($id);

        $pendaftaran->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Pendaftaran Berhasil Dihapus"
        ]);
    }
}
