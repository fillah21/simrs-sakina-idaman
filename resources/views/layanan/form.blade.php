<!-- Modal body -->
<form class="" id="formLayanan" action="{{ $layanan->id ? route('layanan.update',$layanan->id) : route('layanan.store') }}" method="POST">
    @csrf

    @if ($layanan->id)
        @method('put')
    @endif

    <div class="p-4 md:p-5 space-y-4">
        <div class="mb-5">
            <label for="instalasi_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instalasi</label>
            <input type="hidden" name="" id="instalasi-id-value" value="{{ optional($layanan->instalasi)->id }}|{{ optional($layanan->instalasi)->nama_instalasi }}">
            <select id="instalasi_id" name="instalasi_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </select>
        </div>

        <div class="mb-5">
            <label for="kode_layanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Layanan</label>
            <input type="text" name="kode_layanan" value="{{ $layanan->kode_layanan ?? generateKodeLayanan() }}" id="layanan" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
        </div>

        <div class="mb-5">
            <label for="inisial_layanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inisial Layanan</label>
            <input type="text" name="inisial_layanan" value="{{ $layanan->inisial_layanan }}" id="inisial_layanan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>

        <div class="mb-5">
            <label for="nama_layanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Layanan</label>
            <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" id="layanan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="mb-5">
            <label for="harga_layanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Layanan</label>
            <input type="number" min="0" name="harga_layanan" value="{{ $layanan->harga_layanan }}" id="layanan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="mb-5">
            <label for="wajib_rujukan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wajib Rujukan</label>
            <input type="hidden" name="" id="wajib-rujukan-value" value="{{ $layanan->wajib_rujukan }}|{{ $layanan->wajib_rujukan == "0" ? "Tidak" : "Wajib" }}">
            <select id="wajib_rujukan" name="wajib_rujukan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </select>
        </div>
        
    </div>
    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button id="submitFormLayanan" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
    </div>
</form>