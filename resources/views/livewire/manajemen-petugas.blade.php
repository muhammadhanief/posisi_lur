<x-slot:title>Manajemen Petugas</x-slot:title>
<div class="container gap-2 mx-auto md:flex-row">
    <button wire:click='dd'>dd aja</button>
    <div id="bawah container" class="flex-col flex-1 bg-white border border-gray-200 rounded-lg dark:bg-gray-900">
        {{-- start kode kegiatan --}}
        <div class="px-4 py-2 mb-2 text-sm bg-white rounded-t-lg shadow-md dark:bg-gray-800">
            <h4 class="py-1 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Unggah Plot Petugas
            </h4>
            <div class="pb-4 ">
                <label for="countries" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Kegiatan</label>
                <select id="countries" wire:model.live='kegiatan_id'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>Pilih Kegiatan</option>
                    @foreach ($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="kegiatan_id" />
            </div>

            <div class="pb-4 ">
                <label for="countries" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pilih Satuan
                    Wilayah Terkecil</label>
                <select id="countries" wire:model.live='wilayah_terkecil_type_id'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>Pilih Satuan Wilayah Terkecil</option>
                    @foreach ($wilayah_terkecil_types as $wilayah_terkecil_type)
                        <option value="{{ $wilayah_terkecil_type->id }}">{{ $wilayah_terkecil_type->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="wilayah_terkecil_type_id" />
            </div>

            @if ($kegiatan_id && $wilayah_terkecil_type_id)
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <span class="font-medium">Unduh master wilayah <span
                            class="underline hover:cursor-pointer">disini!</span> Perhatikan:</span>
                    <br>
                    <ul class="pl-5 list-disc">
                        <li>Hapus baris yang tidak terpilih ke dalam sampel</li>
                        <li>Isi kolom yang kosong</li>
                        <li>Isian semuanya huruf KAPITAL</li>
                    </ul>
                </div>
                <div class="pb-2 mx-auto">

                    <label for="countries" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Unggah
                        file plot petugas</label>
                    <input wire:model.live='fileImport'
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Format file .xlsx</p>
                    <x-input-error for="fileImport" />
                </div>
                <button wire:click="import" type="button"
                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Impor</button>
            @endif



        </div>
    </div>
</div>
