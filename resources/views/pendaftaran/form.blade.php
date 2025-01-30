@extends('layouts.master')

@section('content')
    <div class="flex justify-end">
        <a href="/pendaftaran" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
    </div>

    <form id="formPendaftaran" action="{{ $pendaftaran->id ? route('pendaftaran.update', $pendaftaran->id) : route('pendaftaran.store') }}" method="POST">
        @csrf

        @if ($pendaftaran->id)
            @method('put')
        @endif

        <input type="hidden" id="wajib_rujukan_layanan" value="{{ $pendaftaran->wajib_rujukan_layanan ?? "0" }}" name="wajib_rujukan_layanan">
        <input type="hidden" id="wajib_rujukan_jaminan" value="{{ $pendaftaran->wajib_rujukan_jaminan ?? "0" }}" name="wajib_rujukan_jaminan">
        <input type="hidden" id="wajib_keterangan_jaminan" value="{{ $pendaftaran->wajib_keterangan_jaminan ?? "0" }}" name="wajib_keterangan_jaminan">
        <div class="sm:grid sm:grid-cols-2">
            {{-- Bagian Kiri --}}
            <div class="p-4 md:p-5 space-y-4">
                <div class="mb-5">
                    <label for="pasien_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pasien</label>
                    <input type="hidden" name="" id="pasien-id-value" value="{{ optional($pendaftaran->pasien)->id }}|{{ optional($pendaftaran->pasien)->nama_pasien }} - {{ optional($pendaftaran->pasien)->nik }} - {{ optional($pendaftaran->pasien)->tanggal_lahir }}">
                    <select id="pasien_id" name="pasien_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>

                <div class="mb-5">
                    <label for="no_pendaftaran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Pendaftaran</label>
                    <input type="text" id="no_pendaftaran" value="{{ $pendaftaran->no_pendaftaran ?? generateNoPendaftaran() }}" name="no_pendaftaran" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
                </div>

                <div class="mb-5">
                    <label for="waktu_kunjungan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Kunjungan</label>
                    <input type="text" autocomplete="off" id="waktu_kunjungan" value="{{ $pendaftaran->waktu_kunjungan ?? now()->format('d/m/Y H:i')}}" name="waktu_kunjungan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                
                <div class="mb-5">
                    <label for="instalasi_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instalasi</label>
                    <input type="hidden" name="" id="instalasi-id-value" value="{{ optional($pendaftaran->instalasi)->id }}|{{ optional($pendaftaran->instalasi)->kode_instalasi }} - {{ optional($pendaftaran->instalasi)->nama_instalasi }}">
                    <select id="instalasi_id" name="instalasi_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>

                <div class="mb-5">
                    <label for="layanan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Layanan</label>
                    <input type="hidden" name="" id="layanan-id-value" value="{{ optional($pendaftaran->layanan)->id }}|{{ optional($pendaftaran->layanan)->kode_layanan }} - {{ optional($pendaftaran->layanan)->nama_layanan }}">
                    <select id="layanan_id" name="layanan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>

                <div class="mb-5">
                    <label for="dokter_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dokter</label>
                    <input type="hidden" name="" id="dokter-id-value" value="{{ optional($pendaftaran->dokter)->id }}|{{ optional($pendaftaran->dokter)->nama_dokter }} - {{ optional($pendaftaran->dokter)->sip }}">
                    <select id="dokter_id" name="dokter_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>
            </div>
    
            {{-- Bagian kanan --}}
            <div class="p-4 md:p-5 space-y-4">
                <div class="mb-5">
                    <label for="jaminan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jaminan</label>
                    <input type="hidden" name="" id="jaminan-id-value" value="{{ optional($pendaftaran->jaminan)->id }}|{{ optional($pendaftaran->jaminan)->nama_jaminan }}">
                    <select id="jaminan_id" name="jaminan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>

                <div class="mb-5">
                    <label for="no_jaminan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Jaminan &nbsp;<span class="text-red-500 hidden tanda_wajib_keterangan">(WAJIB)</span></label>
                    <input type="text" id="no_jaminan" value="{{ $pendaftaran->no_jaminan }}" name="no_jaminan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>

                <div class="mb-5">
                    <label for="nama_penjamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Penjamin &nbsp;<span class="text-red-500 hidden tanda_wajib_keterangan">(WAJIB)</span></label>
                    <input type="text" id="nama_penjamin" value="{{ $pendaftaran->nama_penjamin }}" name="nama_penjamin" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>

                <div class="mb-5">
                    <label for="cara_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cara Masuk</label>
                    <input type="hidden" name="" id="cara-masuk-value" value="{{ $pendaftaran->cara_masuk ? $pendaftaran->cara_masuk . "|" . $pendaftaran->cara_masuk : "" }}">
                    <select id="cara_masuk" name="cara_masuk" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>

                <div class="mb-5">
                    <label for="rujukan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rujukan &nbsp;<span class="text-red-500 hidden tanda_wajib_rujukan">(WAJIB)</span></label>
                    <input type="text" id="rujukan" value="{{ $pendaftaran->rujukan }}" name="rujukan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>

                <div class="mb-5">
                    <label for="tindakan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rencana Tindakan</label>
                    <input type="hidden" name="" id="tindakan-id-value" value="{{ optional($pendaftaran->tindakan)->id }}|{{ optional($pendaftaran->tindakan)->nama_tindakan }}">
                    <select id="tindakan_id" name="tindakan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        
                    </select>
                </div>
            </div>
        </div>
    
        <div class="p-4 md:p-5 space-y-4">
            <div class="mb-5">
                <label for="keluhan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keluhan</label>
                <textarea id="keluhan" name="keluhan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">{{ $pendaftaran->keluhan }}</textarea>
            </div>
        </div>

        <div class="flex justify-end items-center pb-5 space-x-3 rtl:space-x-reverse rounded-b dark:border-gray-600">
            <button id="submitFormPendaftaran" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('js/pendaftaran/function.js') }}"></script>
    <script src="{{ asset('js/pendaftaran/index.js') }}"></script>
@endpush