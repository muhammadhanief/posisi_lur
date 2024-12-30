<x-slot:title>Manajemen Petugas</x-slot:title>
<div class="gap-2 mx-auto md:flex-row">
    {{-- Master Wilayah --}}
    {{-- <button wire:click='dd'>dd aja</button> --}}
    <div class="flex-col flex-1 mt-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
        <div class="flex flex-row justify-between p-2 px-4 mx-6 text-sm bg-white rounded-lg dark:bg-gray-800">
            <h4 class="py-1 text-xl font-semibold text-gray-600 dark:text-gray-300">
                Master Pengawas
            </h4>
            <!-- Modal toggle -->
            @if (auth()->user()->role == 'admin')
                <button data-modal-target="modal-master-wilayah" data-modal-toggle="modal-master-wilayah"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    + Tambah Master Pengawas
                </button>
            @endif
        </div>
        <hr>
        <div class="p-2 px-4 pb-4 text-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
            {{-- tabel --}}
            <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                <table wire:ignore.self
                    class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            {{-- <th scope="col" class="px-6 py-3">
                                ID
                            </th> --}}
                            <th scope="col" class="px-6 py-3">
                                Nama PPL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama kegiatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Password
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode wilayah terkecil
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ID PPL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama PML
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tahun
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users_pegawais as $users_pegawai)
                            <tr wire:key='{{ $users_pegawai->id }}'
                                class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">

                                {{-- <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $users_kegiatan->id }}
                                </th> --}}
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $users_pegawai->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $users_pegawai->hp }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $users_pegawai->password_not_hashed }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $users_pegawai->role }}
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
                    {{ $users_pegawais->links() }}
                </div>
            </div>
        </div>
        @include('livewire.includes.modal-master-petugas')
    </div>
</div>
