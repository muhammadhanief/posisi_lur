<div>
    <div class="flex flex-row">
        <!-- Bagian 2/5 -->
        <div id="kiri" class="flex flex-col ">
            <div class="css-logo">StatTrack</div>
            <h2>StatTrack Menu list</h2>

            <button wire:click='dd'>klik untuk ddddd</button>
            {{-- start kode kegiatan --}}
            <div>

                <h3>Pilih Kode Kegiatan :
                    <div class="relative dropdown-KodeKegiatan">
                        <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchKodeKegiatan"
                            class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button" aria-haspopup="true" aria-expanded="false"
                            onclick="toggleDropdown('dropdownSearchKodeKegiatan');">
                            Kegiatan
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div wire:ignore id="dropdownSearchKodeKegiatan"
                            class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                            <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownSearchButton">
                                <li>
                                    <div
                                        class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input wire:model.live='selectAllKodeKegiatan' id="selectAllKodeKegiatan"
                                            type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="selectAllKodeKegiatan"
                                            class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                            semua</label>
                                    </div>
                                </li>

                                @foreach ($kode_kegiatans as $kode_kegiatan)
                                    <li>
                                        <div
                                            class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input wire:model.live='selectedKodeKegiatan'
                                                id="pelabuhan-{{ $loop->index }}" type="checkbox"
                                                value="{{ $kode_kegiatan }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="pelabuhan-{{ $loop->index }}"
                                                class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kode_kegiatan }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </h3>
            </div>
            {{-- end kode kegiatan --}}

            {{-- start kode kabkota --}}
            <div>
                <h3>Pilih Kab/Kota</h3>
                <div class="relative dropdown-pelabuhan">
                    <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPelabuhan"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" aria-haspopup="true" aria-expanded="false"
                        onclick="toggleDropdown('dropdownSearchPelabuhan');">
                        Kode Kabupaten Kota
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 10">
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
                                    <input wire:model.live='selectAllKodeKabkota' id="selectAllPelabuhan"
                                        type="checkbox"
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
            </div>
            {{-- end kabkot --}}

            {{-- start kode kabkota --}}
            <div>
                <h3>Pilih Tim Lapangan :</h3>
                <div class="relative dropdown-pelabuhan">
                    <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchTimLapangan"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" aria-haspopup="true" aria-expanded="false"
                        onclick="toggleDropdown('dropdownSearchTimLapangan');">
                        Kode Tim
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 10">
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
                                    <div
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
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
                {{-- <h3>Peta SLS? ==>
                    <label for="show_SLS"> Yes</label> <input type="radio" id="show_SLS" name="shd"
                        onchange="ShowHide()">
                    <label for="hide_SLS"> No</label> <input type="radio" id="hide_SLS" name="shd"
                        onchange="ShowHide()" checked>
                </h3> --}}


                {{-- <h3> Buat Jalur Terpendak (SLS Routeku) </h3>
                <label for="start">Dari </label> <select id="start" name="start">
                    <option value="1,1">Posisi Anda</option>
                    <option value="2,2">Mitra A</option>
                    <option value="3,3">Mitra B</option>
                    <option value="4,4">Mitra C</option>
                </select>
                <label for="end">ke</label> <select id="end" name="end">
                    <option value="1,1">Posisi Anda</option>
                    <option value="2,2">Mitra A</option>
                    <option value="3,3">Mitra B</option>
                    <option value="4,4">Mitra C</option>
                </select> --}}
            </div>
            {{-- end kode tim --}}
        </div>
        <div id="kanan" class="flex flex-col ">
            <div class="css-rainbow-text">Voyage to Statistical Work Area</div>
            <div wire:ignore>
                <div id="map-canvas" style="width: 100%; height: 500px"></div>
            </div>
            <div wire:ignore>
                <div id="map" style="width: 100%; height: 380px"></div>
            </div>

            <div wire:ignore id="mapContainer"></div>
            <div>
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
            </div>
        </div>
        {{-- testing aja dalam bentuk tabel --}}


        {{-- end testing --}}
    </div>

    @script
        <script>
            $wire.on('updateMap', (data) => {
                // var map = new google.maps.Map(document.getElementById('map-canvas'), {
                //     center: {
                //         lat: -7.048929,
                //         lng: 110.492233

                //     },
                //     zoom: 9,
                //     mapTypeId: google.maps.MapTypeId.ROADMAP,
                // });
                // Loop untuk menambahkan marker setiap petugas
                // console.log(data);
                // Mengambil latitude dan longitude dan memasukkannya ke dalam array baru
                var coordinates = data[0].map(item => ({
                    lat: parseFloat(item.latitude),
                    lng: parseFloat(item.longitude)
                }));
                // console.log(coordinates);

                // coordinates.forEach(function(coord) {

                //     var marker = new google.maps.Marker({
                //         position: {
                //             lat: coord.lat,
                //             lng: coord.lng
                //         },
                //         map: map,
                //     });
                // });


                // console.log(coordinates);
                coordinates.forEach(function(coord) {
                    var marker2 = L.marker([coord.lat, coord.lng]).addTo(map2);
                    console.log(coord.lat, coord.lng);
                });

                // var map2 = L.map("map").setView([-7.057190, 110.496424], 13);
                // L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                //     maxZoom: 19,
                //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                // }).addTo(map2);
                // var marker2 = L.marker([51.5, -0.09]).addTo(map2);
                // var marker3 = L.marker([51.1, -0.09]).addTo(map2);
            });
        </script>
    @endscript

</div>
{{-- <div class="Marquee-box">
        <marquee class="MyMarquee" id="my_marquee" direction="left" behavior="2" scrollamount="6"
            onmouseover="this.stop()" onmouseout="this.start()">
            <h3> Pengumuman dilarang menggunakan gelas yang sudah dipakai orang sakit
                <img src="https://html-generator.com/uploads/images/2024/12/08/47497W6FUWD87C4.png" width="30"
                    height="20" alt="marquee image">
                Ingat Kesehatan anda lebih utama
            </h3>
        </marquee>
    </div> --}}
