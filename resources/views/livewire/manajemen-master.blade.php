<x-slot:title>Manajemen Master</x-slot:title>
<div class="gap-2 mx-auto md:flex-row">
    {{-- Master Wilayah --}}
    {{-- <p>{{ $locale }}</p> --}}
    <div class="flex-col flex-1 mt-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
        <div class="flex flex-row justify-between p-2 px-4 mx-6 text-sm bg-white rounded-lg dark:bg-gray-800">
            <h4 class="py-1 text-xl font-semibold text-gray-600 dark:text-gray-300">
                Master Wilayah
            </h4>
            <!-- Modal toggle -->
            <button data-modal-target="modal-master-wilayah" data-modal-toggle="modal-master-wilayah"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                + Tambah Master Wilayah
            </button>
        </div>
        <hr>
        <div class="p-2 px-4 pb-4 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            {{-- tabel --}}
            <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                <table wire:ignore.self
                    class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Provinsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Kabkot
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Kecamatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Desa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Wilayah Terkecil
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Wilayah Full
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Wilayah Terkecil
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wilayah_terkecils as $wilayah_terkecil)
                            <tr wire:key='{{ $wilayah_terkecil->id }}'
                                class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $wilayah_terkecil->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->kd_provinsi }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->kd_kabkot }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->kd_kecamatan }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->kd_desa }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->kd_wilayah_terkecil }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->kd_full }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wilayah_terkecil->nm_wilayah_terkecil }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-2 ">
                    {{ $wilayah_terkecils->links() }}
                </div>
            </div>
        </div>
        @include('livewire.includes.modal-master-wilayah')
    </div>

    {{-- master kegiatan --}}
    <div class="flex-col flex-1 mt-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
        <div class="flex flex-row justify-between p-2 px-4 mx-6 text-sm bg-white rounded-lg dark:bg-gray-800">
            <h4 class="py-1 text-xl font-semibold text-gray-600 dark:text-gray-300">
                Master Kegiatan
            </h4>
            <!-- Modal toggle -->
            <button data-modal-target="modal-master-kegiatan" data-modal-toggle="modal-master-kegiatan"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                + Tambah Master Kegiatan
            </button>
        </div>
        <hr>
        <div class="p-2 px-4 pb-4 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            {{-- tabel --}}
            <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                <table wire:ignore.self
                    class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kegiatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatans as $kegiatan)
                            <tr
                                class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $kegiatan->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $kegiatan->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $kegiatan->description }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-2 ">
                    {{ $kegiatans->links() }}
                </div>
            </div>
        </div>
        @include('livewire.includes.modal-master-kegiatan')
    </div>


</div>
