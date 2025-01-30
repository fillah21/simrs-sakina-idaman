<!-- Modal body -->
<form class="" id="formTindakan" action="{{ $tindakan->id ? route('tindakan.update',$tindakan->id) : route('tindakan.store') }}" method="POST">
    @csrf

    @if ($tindakan->id)
        @method('put')
    @endif

    <div class="p-4 md:p-5 space-y-4">
        <div class="mb-5">
            <label for="layanan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instalasi</label>
            <input type="hidden" name="" id="layanan-id-value" value="{{ optional($tindakan->layanan)->id }}|{{ optional($tindakan->layanan)->nama_layanan }}">
            <select id="layanan_id" name="layanan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </select>
        </div>

        <div class="mb-5">
            <label for="kode_tindakan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tindakan</label>
            <input type="text" name="kode_tindakan" value="{{ $tindakan->kode_tindakan ?? generateKodeTindakan() }}" id="tindakan" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
        </div>

        <div class="mb-5">
            <label for="nama_tindakan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Tindakan</label>
            <input type="text" name="nama_tindakan" value="{{ $tindakan->nama_tindakan }}" id="tindakan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="mb-5">
            <label for="harga_tindakan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Tindakan</label>
            <input type="number" min="0" name="harga_tindakan" value="{{ $tindakan->harga_tindakan }}" id="tindakan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>
        
    </div>
    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button id="submitFormTindakan" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
    </div>
</form>