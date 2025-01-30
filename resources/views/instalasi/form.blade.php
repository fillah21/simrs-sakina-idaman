<!-- Modal body -->
<form class="" id="formInstalasi" action="{{ $instalasi->id ? route('instalasi.update',$instalasi->id) : route('instalasi.store') }}" method="POST">
    @csrf

    @if ($instalasi->id)
        @method('put')
    @endif

    <div class="p-4 md:p-5 space-y-4">
        <div class="mb-5">
            <label for="kode_instalasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Instalasi</label>
            <input type="text" name="kode_instalasi" value="{{ $instalasi->kode_instalasi ?? generateKodeInstalasi() }}" id="instalasi" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
        </div>

        <div class="mb-5">
            <label for="nama_instalasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Instalasi</label>
            <input type="text" name="nama_instalasi" value="{{ $instalasi->nama_instalasi }}" id="instalasi" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="mb-5">
            <label for="is_antrian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Butuh Antrian</label>
            <input type="hidden" name="" id="is-antrian-value" value="{{ $instalasi->is_antrian }}|{{ $instalasi->is_antrian == "0" ? "Tidak" : "Butuh" }}">
            <select id="is_antrian" name="is_antrian" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </select>
        </div>
        
    </div>
    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button id="submitFormInstalasi" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
    </div>
</form>