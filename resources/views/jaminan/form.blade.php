<!-- Modal body -->
<form class="" id="formJaminan" action="{{ $jaminan->id ? route('jaminan.update',$jaminan->id) : route('jaminan.store') }}" method="POST">
    @csrf

    @if ($jaminan->id)
        @method('put')
    @endif

    <div class="p-4 md:p-5 space-y-4">
        <div class="mb-5">
            <label for="kode_jaminan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jaminan</label>
            <input type="text" name="kode_jaminan" value="{{ $jaminan->kode_jaminan ?? generateKodeJaminan() }}" id="jaminan" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
        </div>

        <div class="mb-5">
            <label for="nama_jaminan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Jaminan</label>
            <input type="text" name="nama_jaminan" value="{{ $jaminan->nama_jaminan }}" id="jaminan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="mb-5">
            <label for="wajib_rujukan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wajib Rujukan</label>
            <input type="hidden" name="" id="wajib-rujukan-value" value="{{ $jaminan->wajib_rujukan }}|{{ $jaminan->wajib_rujukan == "0" ? "Tidak" : "Wajib" }}">
            <select id="wajib_rujukan" name="wajib_rujukan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </select>
        </div>

        <div class="mb-5">
            <label for="wajib_keterangan_jaminan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wajib Keterangan Jaminan</label>
            <input type="hidden" name="" id="wajib-keterangan-jaminan-value" value="{{ $jaminan->wajib_keterangan_jaminan }}|{{ $jaminan->wajib_keterangan_jaminan == "0" ? "Tidak" : "Wajib" }}">
            <select id="wajib_keterangan_jaminan" name="wajib_keterangan_jaminan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </select>
        </div>
        
    </div>
    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button id="submitFormJaminan" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
    </div>
</form>