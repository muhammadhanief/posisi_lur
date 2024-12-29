<x-slot:title>Monitoring Petugas</x-slot:title>
<div class="flex flex-col gap-2 mx-auto md:flex-row">
    <!-- Bagian 2/5 -->
    <div id="kiri" class="flex-col bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
        <button wire:click='coba'>Munculkan peta sls</button>
        <button wire:click='dd'>DDDD</button>

        {{-- <button wire:click='ddasli'>Munculkan debug</button> --}}
        {{-- start kode kegiatan --}}
        {{-- <p wire:click='getPolygonsForAllUsers'>getPolygonsForAllUsers</p> --}}
        <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">
            <h4 class="px-2 py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Filter Petugas yang Akan Ditampilkan
            </h4>
        </div>
        <div wire:loading role="status" class="flex items-center justify-center pt-2 text-blue-500">
            <div class="flex flex-row items-center gap-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <div role="status">
                    <svg aria-hidden="true"
                        class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-purple-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="flex flex-col">
                    <div>
                        <span class="font-medium">Melakukan input data</span>. Mohon tunggu
                        beberapa
                        saat...
                    </div>
                    <div>
                        Maaf yaa lama 🙏🏻, datanya banyak 🫠
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Kegiatan
            </p>
            <div class="relative dropdown-KodeKegiatan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchKodeKegiatan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchKodeKegiatan');">
                    Kegiatan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchKodeKegiatan"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        {{-- <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeKegiatan' id="selectAllKodeKegiatan"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllKodeKegiatan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li> --}}

                        @foreach ($kegiatans as $kegiatan)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeKegiatan' id="pelabuhan-{{ $loop->index }}"
                                        type="radio" value={{ $kegiatan->id }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kegiatan->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- end kode kegiatan --}}

        {{-- start kode prov --}}
        {{-- <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Provinsi
            </p>

            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchProvinsi"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchProvinsi');">
                    Kode Provinsi
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchProvinsi"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeKabkota' id="selectAllPelabuhan" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllPelabuhan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>
                        @foreach ($kode_kabkotas as $kode_kabkota)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeKabkota' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kode_kabkota }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_kabkota }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- end prov --}}

        {{-- start kode kabkota --}}
        <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Kabupaten/Kota
            </p>

            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPelabuhan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPelabuhan');">
                    Kode Kabupaten/Kota
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPelabuhan"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeKabkota' id="selectAllPelabuhan" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllPelabuhan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>
                        @foreach ($kode_kabkotas as $kode_kabkota)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeKabkota' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kode_kabkota->kd_kabkot }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_kabkota->kd_kabkot }}
                                        {{ $kode_kabkota->nm_kabkot }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        {{-- end kabkot --}}

        {{-- start kode kecamatan --}}
        {{-- <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Kecamatan
            </p>

            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchKecamatan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchKecamatan');">
                    Kode Kecamatan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchKecamatan"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeKecamatan' id="selectAllPelabuhan"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllPelabuhan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>
                        @foreach ($kode_kecamatans as $kode_kecamatan)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeKecamatan' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kode_kecamatan->kd_kecamatan }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_kecamatan->kd_kecamatan }}
                                        {{ $kode_kecamatan->nm_kecamatan }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- end kecamatan --}}

        {{-- start kode desa --}}
        {{-- <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Desa
            </p>

            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchDesa"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchDesa');">
                    Kode Desa
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchDesa"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeKabkota' id="selectAllPelabuhan" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllPelabuhan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>
                        @foreach ($kode_kabkotas as $kode_kabkota)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeKabkota' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kode_kabkota }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_kabkota }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- end desa --}}

        {{-- start wilayah terkecil --}}
        {{-- <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Wilayah Terkecil
            </p>

            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchWilayahTerkecil"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchWilayahTerkecil');">
                    Kode Desa
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchWilayahTerkecil"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeKabkota' id="selectAllPelabuhan" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllPelabuhan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>
                        @foreach ($kode_kabkotas as $kode_kabkota)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeKabkota' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kode_kabkota }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_kabkota }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- end desa --}}

        {{-- start kode tim --}}
        {{-- <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Tim Lapangan
            </p>
            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchTimLapangan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchTimLapangan');">
                    Kode Tim
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchTimLapangan"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllKodeTim' id="selectAllKodeTim" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllKodeTim"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>

                        @foreach ($kode_tims as $kode_tim)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeTim' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kode_tim }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_tim }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- end kode tim --}}

        {{-- start kode kabkota --}}
        {{-- <div class="px-4 pb-2 mb-2 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="pb-1 text-gray-700 dark:text-gray-400">
                Pilih Peta SLS
            </p>
            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPetaSls"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPetaSls');">
                    Peta SLS
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPetaSls"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">

                        @foreach ($geojsonFilesNames as $geojsonFilesName)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKodeSls' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $geojsonFilesName }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $geojsonFilesName }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- end kode tim --}}
    </div>
    <div class="flex-col flex-1">
        <div class="flex-col mb-2 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
            <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">
                <h4 class="px-2 py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                    Cari Salah Satu Petugas
                </h4>
            </div>
            <div id="kolom-pencarian" class="flex flex-col px-4 py-2 mb-2">
                <div class="relative w-full max-w-xl focus-within:text-purple-500 ">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d=" M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        wire:model.live.debounce.500ms="search" type="text" placeholder="Ketik nama petugas.." />
                </div>
                <span class="text-xs text-red-700 dark:text-red-400">Kosongkan ini jika menggunakan fitur
                    filter!</span>
            </div>
        </div>

        <div id="kanan" class="flex-col bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
            <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">
                <h4 class="px-2 py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                    Peta Posisi Petugas
                </h4>
            </div>
            {{-- <div wire:ignore>
                <div id="map-canvas" style="width: 100%; height: 500px"></div>
            </div> --}}
            <div wire:ignore class="px-2 py-1">
                <div id="map" style="width: 100%; height: 380px"></div>
            </div>

            {{-- <div wire:ignore id="mapContainer"></div> --}}


            <div class="p-2 px-4 pb-4 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
                {{-- tabel --}}
                <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                    <table wire:ignore.self
                        class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 border">Nama</th>
                                <th class="px-6 py-3 border">Kode Wilayah</th>
                                <th class="px-6 py-3 border">No Hp</th>
                                <th class="px-6 py-3 border">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($selectedKodeWilayahTerkecilModel != null)
                                @foreach ($selectedKodeWilayahTerkecilModel as $selectedKodeWilayahTerkecil)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $selectedKodeWilayahTerkecil->user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $selectedKodeWilayahTerkecil->kd_full }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $selectedKodeWilayahTerkecil->user->hp }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $selectedKodeWilayahTerkecil->user->password_not_hashed }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4">
                                        Belum Ada data
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="px-2 py-1">
                <table class="w-full border border-gray-300 table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Kode Kegiatan</th>
                            <th class="px-4 py-2 border">Kode Kab/Kota</th>
                            <th class="px-4 py-2 border">Kode Petugas</th>
                            <th class="px-4 py-2 border">Nama Petugas</th>
                            <th class="px-4 py-2 border">Timestamp</th>
                            <th class="px-4 py-2 border">Latitude</th>
                            <th class="px-4 py-2 border">Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($filteredResults as $result)
                            <tr>
                                <td class="px-4 py-2 border">{{ $result->id }}</td>
                                <td class="px-4 py-2 border">{{ $result->kode_kegiatan }}</td>
                                <td class="px-4 py-2 border">{{ $result->kode_kabkota }}</td>
                                <td class="px-4 py-2 border">{{ $result->kode_petugas }}</td>
                                <td class="px-4 py-2 border">{{ $result->nama_petugas }}</td>
                                <td class="px-4 py-2 border">{{ $result->timestamp }}</td>
                                <td class="px-4 py-2 border">{{ $result->latitude }}</td>
                                <td class="px-4 py-2 border">{{ $result->longitude }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-2 text-center border">No results found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
    {{-- testing aja dalam bentuk tabel --}}


    {{-- end testing --}}



    @script
        <script>
            $wire.on('updateMap', (data) => {
                // Bersihkan LayerGroup
                markersGroup.clearLayers();

                // Ambil koordinat dari data
                var coordinates = data[0].map(item => ({
                    lat: parseFloat(item.latitude),
                    lng: parseFloat(item.longitude)
                }));

                // Tambahkan marker dengan event click
                coordinates.forEach(function(coord) {
                    var marker2 = L.marker([coord.lat, coord.lng]);

                    // Tambahkan event listener klik ke marker
                    marker2.on('click', function() {
                        var lat = coord.lat;
                        var lng = coord.lng;

                        // URL Google Maps
                        var googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                        window.open(googleMapsUrl, '_blank');
                    });

                    // Tambahkan marker ke LayerGroup
                    markersGroup.addLayer(marker2);
                });
            });




            // Livewire listener untuk update layer GeoJSON
            $wire.on('updateGeojsonLayers', (selectedKodeSls) => {
                console.log("Selected Kode SLS (Before Flatten):", selectedKodeSls);

                // Pastikan array datar
                selectedKodeSls = selectedKodeSls.flat();
                console.log("Selected Kode SLS (Flattened):", selectedKodeSls);

                // Kosongkan semua layer GeoJSON yang ada sebelumnya
                geojsonLayers.clearLayers();

                // Iterasi melalui setiap kode SLS dan ambil file GeoJSON terkait
                selectedKodeSls.forEach((kodeSls) => {
                    const geojsonUrl = `/geojson/${kodeSls}`; // URL setiap file GeoJSON

                    // Ambil file GeoJSON
                    fetch(geojsonUrl)
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error(`Failed to fetch GeoJSON for ${kodeSls}`);
                            }
                            return response.json(); // Parse JSON
                        })
                        .then((geojsonData) => {
                            var options = {
                                maxZoom: 16,
                                tolerance: 3,
                                debug: 0,
                                style: {
                                    color: "#FF0000", // Garis berwarna merah
                                    weight: 1, // Ketebalan garis
                                    fill: false, // Tidak ada warna fill (menghilangkan isian)
                                    fillOpacity: 0.9, // Menghilangkan isian
                                },
                            };

                            // Tambahkan GeoJSON ke layer group
                            const geojsonLayer = L.geoJson(geojsonData, options);
                            geojsonLayers.addLayer(geojsonLayer);
                        })
                        .catch((error) =>
                            console.error(`Error loading GeoJSON for ${kodeSls}:`, error)
                        );
                });
            });

            $wire.on('geojsonLoaded', (geojsonCollection) => {
                console.log("GeoJSON FeatureCollection Received:", geojsonCollection);

                // Kosongkan semua layer GeoJSON yang ada sebelumnya
                geojsonLayers.clearLayers();

                // Opsi untuk layer GeoJSON
                var options = {
                    maxZoom: 16,
                    tolerance: 3,
                    debug: 0,
                    style: {
                        color: "#FF0000", // Garis berwarna merah
                        weight: 3, // Ketebalan garis
                        fill: true, // Isian diaktifkan
                        fillOpacity: 0.2, // Transparansi isian
                    },
                    onEachFeature: function(feature, layer) {
                        // Buat konten tooltip menggunakan properties dari setiap fitur
                        const tooltipContent = `
                            ${feature.properties.kdkab} ${feature.properties.nmkab}<br>
                            ${feature.properties.kdkec} ${feature.properties.nmkec}<br>
                            ${feature.properties.kdsls} ${feature.properties.nmsls}<br>
                            ${feature.properties.kddesa} ${feature.properties.nmdesa}<br>
                            PPL: ${feature.properties.name}<br>
                            <b>ID SLS:</b> ${feature.properties.idsls}
                        `;
                        // Tambahkan tooltip ke layer
                        layer.bindTooltip(tooltipContent, {
                            permanent: false, // Tooltip hanya muncul saat dihover
                            direction: "top", // Arah munculnya tooltip
                        });

                    },
                };

                // Tambahkan GeoJSON FeatureCollection ke layer group
                const geojsonLayer = L.geoJson(geojsonCollection, options);
                geojsonLayers.addLayer(geojsonLayer);
            });
        </script>
    @endscript
</div>
