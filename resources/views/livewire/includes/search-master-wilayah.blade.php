<div class="flex-col flex-1 mt-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
    <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">

        <h4 class="py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Cari Master Wilayah
        </h4>

        {{-- tabel --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table wire:ignore class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
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
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
</div>
