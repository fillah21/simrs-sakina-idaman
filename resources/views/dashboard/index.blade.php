@extends('layouts.master')

@section('content')
    <h1 class="flex justify-center text-4xl font-bold">Selamat Datang Di SIM RS </h1>

    <div class="flex justify-center mt-10">
        <button data-modal-target="modalForm" data-modal-toggle="modalForm" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat Pendaftaran</button>   
    </div>

    <div id="modalForm" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Buat Pendaftaran
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalForm">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="mb-3">Pilih pasien dan klik tombol "Pasien Lama" untuk pasien lama, atau klik tombol "Pasien Baru" untuk pasien baru</p>
                    <div class="mb-5">
                        <label for="pasien_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pasien</label>
                        {{-- <input type="hidden" name="" id="pasien-id-value" value="{{ optional($pendaftaran->pasien)->id }}|{{ optional($pendaftaran->pasien)->nama_pasien }} - {{ optional($pendaftaran->pasien)->nik }} - {{ optional($pendaftaran->pasien)->tanggal_lahir }}"> --}}
                        <select style="width: 100% !important" id="pasien_id" name="pasien_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            
                        </select>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-center items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="buttonPasienLama" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pasien Lama</button>
                    <a href="/pasien?pasien_baru=true" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-500 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Pasien Baru</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/dashboard/index.js') }}"></script>
@endpush