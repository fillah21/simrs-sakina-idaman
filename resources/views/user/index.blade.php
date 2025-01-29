@extends('layouts.master')

@section('content')
    <div class="flex justify-end">
        <button id="buttonTambahUser" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah User</button>
        <button id="showModalUser" data-modal-target="modalFormUser" data-modal-toggle="modalFormUser" type="button" class="hidden text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah User</button>
    </div>

    <div class="table-responsive">
        {{ $dataTable->table() }}

    </div>

    <div id="modalFormUser" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div id="modal-header" class="items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 hidden">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white" id="modalTitle">
                        Large modal
                    </h3>
                    <button type="button" id="bottonCloseModalFormUser" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalFormUser">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <div class="modal-dialog"></div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('js/user/function.js') }}"></script>
    <script src="{{ asset('js/user/index.js') }}"></script>
@endpush