<!-- Modal body -->
<form class="" id="formPasien" action="{{ $pasien->id ? route('pasien.update',$pasien->id) : route('pasien.store') }}" method="POST">
    @csrf

    @if ($pasien->id)
        @method('put')
    @endif

    <div class="grid grid-cols-2">
        {{-- Bagian Kiri --}}
        <div class="p-4 md:p-5 space-y-4">
            <div class="mb-5">
                <label for="nama_pasien" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pasien</label>
                <input type="text" name="nama_pasien" value="{{ $pasien->nama_pasien }}" id="nama_pasien" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="mb-5">
                <label for="no_rm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. RM</label>
                <input type="text" id="no_rm" value="{{ $pasien->no_rm ?? generateNoRM() }}" name="no_rm" class="border bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
            </div>
            <div class="mb-5">
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                <input type="number" id="nik" value="{{ $pasien->nik }}" name="nik" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>        
            <div class="mb-5">
                <label for="jk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                <input type="hidden" name="" id="jk-value" value="{{ $pasien->jk }}">
                <select id="jk" name="jk" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
                </select>
            </div>
    
            <div class="mb-5">
                <label for="status_nikah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Nikah</label>
                <input type="hidden" name="" id="status-nikah-value" value="{{ $pasien->status_nikah ? $pasien->status_nikah . "|" . $pasien->status_nikah : "" }}">
                <select id="status_nikah" name="status_nikah" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>        
            
            <div class="mb-5">
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" value="{{ $pasien->tempat_lahir }}" name="tempat_lahir" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
            </div>

            <div class="mb-5">
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                <input type="text" placeholder="dd/mm/yy" autocomplete="off" id="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" name="tanggal_lahir" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
            </div>
        </div>

        {{-- Bagian kanan --}}
        <div class="p-4 md:p-5 space-y-4">
            <div class="mb-5">
                <label for="provinsi_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi Asal</label>
                <input type="hidden" name="" id="provinsi-id-value" value="{{ optional($pasien->provinsi)->id}}|{{ optional($pasien->provinsi)->nama_provinsi }}">
                <select id="provinsi_id" name="provinsi_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </select>
            </div>      
            <div class="mb-5">
                <label for="kabupaten_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten Asal</label>
                <input type="hidden" name="" id="kabupaten-id-value" value="{{ optional($pasien->kabupaten)->id}}|{{ optional($pasien->kabupaten)->tipe_kabupaten }} {{ optional($pasien->kabupaten)->nama_kabupaten }}">
                <select id="kabupaten_id" name="kabupaten_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>        
            <div class="mb-5">
                <label for="kecamatan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan Asal</label>
                <input type="hidden" name="" id="kecamatan-id-value" value="{{ optional($pasien->kecamatan)->id}}|{{ optional($pasien->kecamatan)->nama_kecamatan }}">
                <select id="kecamatan_id" name="kecamatan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>
            <div class="mb-5">
                <label for="kelurahan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelurahan Asal</label>
                <input type="hidden" name="" id="kelurahan-id-value" value="{{ optional($pasien->kelurahan)->id}}|{{ optional($pasien->kelurahan)->nama_kelurahan }}">
                <select id="kelurahan_id" name="kelurahan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>
            <div class="mb-5">
                <label for="agama_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                <input type="hidden" name="" id="agama-id-value" value="{{ optional($pasien->agama)->id}}|{{ optional($pasien->agama)->agama }}">
                <select id="agama_id" name="agama_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>
            <div class="mb-5">
                <label for="pendidikan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                <input type="hidden" name="" id="pendidikan-id-value" value="{{ optional($pasien->pendidikan)->id}}|{{ optional($pasien->pendidikan)->pendidikan }}">
                <select id="pendidikan_id" name="pendidikan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>
            <div class="mb-5">
                <label for="pekerjaan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
                <input type="hidden" name="" id="pekerjaan-id-value" value="{{ optional($pasien->pekerjaan)->id}}|{{ optional($pasien->pekerjaan)->nama_pekerjaan }}">
                <select id="pekerjaan_id" name="pekerjaan_id" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    
                </select>
            </div>
            
        </div>
    </div>

    <div class="p-4 md:p-5 space-y-4">
        <div class="mb-5">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">{{ $pasien->alamat }}</textarea>
        </div>
    </div>

    <!-- Modal footer -->
    <div class="flex justify-end items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button id="submitFormPasien" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>    
    </div>
</form>