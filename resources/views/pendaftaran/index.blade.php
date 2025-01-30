@extends('layouts.master')

@section('content')
    <div class="flex justify-end">
        <a href="pendaftaran/create" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat Pendaftaran</a>
    </div>

    <div class="table-responsive">
        {{ $dataTable->table() }}
    </div>
@endsection

@push('script')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('js/pendaftaran/function.js') }}"></script>
    <script src="{{ asset('js/pendaftaran/index.js') }}"></script>
@endpush