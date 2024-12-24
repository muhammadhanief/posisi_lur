<div class="flex-col flex-1 mt-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
    <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">
        @if ($isCreateNewKegiatanOpen == false)
            <h4 class="py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Master Kegiatan
            </h4>
            <button type="button" wire:click='showCreateNewKegiatan'
                class="px-3 py-2 mb-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah
                Kegiatan</button>
        @else
            <h4 class="py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Tambah Master Kegiatan Baru
            </h4>
            <div class="pb-2">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Kegiatan</label>
                <input wire:model='newKegiatanName' type="text" id="default-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <x-input-error for="newKegiatanName" />
            </div>
            <div class="pb-2">
                <label for="default-input"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                    Kegiatan</label>
                <input wire:model='newKegiatanDesc' type="text" id="default-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <x-input-error for="newKegiatanDesc" />
            </div>
            <div class="">
                <button type="button" wire:click='createNewKegiatan'
                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                <button type="button" wire:click='cancelNewKegiatan'
                    class="px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-red-300 focus:ring-4 focus:outline-none dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Batal</button>


            </div>

            <h4 class="py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Master Kegiatan
            </h4>
        @endif


    </div>
    <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">
        {{-- tabel --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table wire:ignore class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
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
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
</div>
