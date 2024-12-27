{{-- modal master wilayah --}}
<div wire:ignore.self id="modal-master-wilayah" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Unggah Master Wilayah
                </h3>
                <button type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal-master-wilayah">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4 md:p-5">
                <div id="info peraturan"
                    class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">

                    <span class="font-medium">Unduh templat master wilayah <span
                            class="underline hover:cursor-pointer"><a
                                href="{{ asset('file/Template Master Wilayah.xlsx') }}" download>
                                disini
                            </a></span> Perhatikan:</span>
                    <br>
                    <ul class="pl-5 list-disc">
                        <li>Jangan ubah baris pertama</li>
                        <li>Samakan isian dengan contoh yang ada pada baris kedua</li>
                        <li>Hapus baris kedua pada templat ini</li>
                        <li>Isian semuanya huruf KAPITAL</li>
                    </ul>
                </div>
                <div class="pb-4 mx-auto">
                    <label for="countries" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pilih
                        tipe
                        wilayah terkecil</label>
                    <select id="countries" wire:model.live='wilayah_terkecil_type_id'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Pilih Jenis Wilayah</option>
                        @foreach ($wilayah_terkecil_types as $wilayah_terkecil_type)
                            <option value="{{ $wilayah_terkecil_type->id }}">{{ $wilayah_terkecil_type->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="wilayah_terkecil_type_id" />
                </div>
                <div class="pb-2 mx-auto">
                    <label for="countries" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Unggah
                        file master wilayah yang telah kamu isi</label>
                    <input wire:model.live='fileImport'
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Format file
                        .xlsx</p>
                    <x-input-error for="fileImport" />
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                <button wire:click="import" type="button"
                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Impor</button>

                <button data-modal-hide="modal-master-wilayah" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
            </div>
        </div>
    </div>
</div>
