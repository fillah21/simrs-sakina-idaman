<!-- Modal body -->
<form class="" id="formPekerjaan" action="{{ $pekerjaan->id ? route('pekerjaan.update',$pekerjaan->id) : route('pekerjaan.store') }}" method="POST">
    @csrf

    @if ($pekerjaan->id)
        @method('put')
    @endif

    <div class="p-4 md:p-5 space-y-4">
        <div class="mb-5">
            <label for="kode_pekerjaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pekerjaan</label>
            <input type="text" name="kode_pekerjaan" value="{{ $pekerjaan->kode_pekerjaan ?? generateKodePekerjaan() }}" id="pekerjaan" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
        </div>

        <div class="mb-5">
            <label for="nama_pekerjaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pekerjaan</label>
            <input type="text" name="nama_pekerjaan" value="{{ $pekerjaan->nama_pekerjaan }}" id="pekerjaan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>
        
    </div>
    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button id="submitFormPekerjaan" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
    </div>
</form>