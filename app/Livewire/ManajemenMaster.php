<?php

namespace App\Livewire;

use App\Imports\WilayahTerkecilImport;
use App\Models\Kegiatan;
use App\Models\WilayahTerkecil;
use App\Models\WilayahTerkecilType;
use Exception;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class ManajemenMaster extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    #[Validate('required|mimes:xlsx')]
    public $fileImport;

    #[Validate('required|not_in:')]
    public $wilayah_terkecil_type_id;

    public function import()
    {
        set_time_limit(300);
        $this->validate([
            'fileImport' => 'required|mimes:xlsx',
            'wilayah_terkecil_type_id' => 'required|not_in:'
        ]);
        // dd($this->fileImport);
        try {
            // Proses impor menggunakan WilayahTerkecilImport
            Excel::import(new WilayahTerkecilImport($this->wilayah_terkecil_type_id), $this->fileImport);

            // Reset file setelah impor
            $this->reset(['fileImport', 'wilayah_terkecil_type_id']);

            // Kirim notifikasi berhasil
            $this->alert('success', 'Sukses!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Master Wilayah Sukses Ditambahkan!',
            ]);
            $this->render();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Menangani validasi yang gagal
            $failures = $e->failures();
            $errorMessages = '';

            foreach ($failures as $failure) {
                // Menyusun pesan kesalahan
                $errorMessages .= 'Baris: ' . $failure->row() . ' - ';
                $errorMessages .= 'Kesalahan: ' . implode(', ', $failure->errors()) . ' | ';
                $errorMessages .= 'Nilai: ' . implode(', ', $failure->values()) . "\n";
            }

            // Tampilkan pesan kesalahan
            $this->alert('error', 'Gagal!', [
                'position' => 'center',
                'toast' => true,
                'text' => $errorMessages,
                'showConfirmButton' => true, // Menampilkan tombol OK
                'confirmButtonText' => 'OK', // Teks tombol
                'allowOutsideClick' => false, // Menghindari klik di luar untuk menutup alert
                'timer' => null, // Tidak menghilang otomatis
            ]);
        } catch (Exception $e) {
            // Menangani kesalahan lainnya
            $this->alert('error', 'Gagal!', [
                'position' => 'center',
                'toast' => true,
                'text' => $e->getMessage(),
                'showConfirmButton' => true, // Menampilkan tombol OK
                'confirmButtonText' => 'OK', // Teks tombol
                'allowOutsideClick' => false, // Menghindari klik di luar untuk menutup alert
                'timer' => null, // Tidak menghilang otomatis
            ]);
        }
    }


    // MASTER KEGIATAN
    #[Validate('required|unique:kegiatans,name')]
    public $newKegiatanName;
    #[Validate('required')]
    public $newKegiatanDesc;

    public function createNewKegiatan()
    {
        // Validasi input
        $this->validate([
            'newKegiatanName' => 'required|unique:kegiatans,name',
            'newKegiatanDesc' => 'required',
        ]);

        // Jika validasi berhasil, buat data baru dan tutup modal
        Kegiatan::create([
            'name' => $this->newKegiatanName,
            'description' => $this->newKegiatanDesc,
        ]);

        // Reset input fields setelah sukses
        $this->reset(['newKegiatanName', 'newKegiatanDesc']);


        // Tampilkan SweetAlert setelah berhasil
        $this->alert('success', 'Sukses!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Master Kegiatan Sukses Ditambahkan!',
        ]);
    }


    public function render()
    {
        return view('livewire.manajemen-master', [
            'wilayah_terkecil_types' => WilayahTerkecilType::all(),
            'wilayah_terkecils' => WilayahTerkecil::paginate(10, ['*'], 'firstTablePage'),
            'kegiatans' => Kegiatan::paginate(10, ['*'], 'secondTablePage'),
            'locale' => App::currentLocale(),
        ]);
    }
}
