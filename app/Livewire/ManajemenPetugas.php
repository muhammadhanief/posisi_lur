<?php

namespace App\Livewire;

use App\Exports\TemplatePlotPetugasExport;
use App\Imports\PetugasImport;
use Livewire\Component;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\UsersKegiatan;
use App\Models\WilayahTerkecilType;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ManajemenPetugas extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    #[Validate('required|not_in:')]
    public $kegiatan_id;
    #[Validate('required|not_in:')]
    public $wilayah_terkecil_type_id;
    #[Validate('required|mimes:xlsx')]
    public $fileImport;

    public function dd()
    {
        dd($this->all());
    }

    public function downloadMasterPetugas()
    {
        return (new TemplatePlotPetugasExport($this->wilayah_terkecil_type_id))->download('template-plot-petugas.xlsx');
    }


    public function import()
    {
        // Validasi file yang diunggah
        $this->validate([
            'fileImport' => 'required|file|mimes:xlsx,csv',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'wilayah_terkecil_type_id' => 'required|exists:wilayah_terkecil_types,id',
        ]);


        try {
            // Proses impor menggunakan PetugasImport
            Excel::import(new PetugasImport($this->kegiatan_id), $this->fileImport);

            // Reset file setelah impor
            $this->reset(['fileImport', 'kegiatan_id', 'wilayah_terkecil_type_id']);

            // Kirim notifikasi berhasil
            $this->alert('success', 'Sukses!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Data petugas berhasil diimpor!',
            ]);
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


        // try {
        //     // Proses impor menggunakan PetugasImport
        //     Excel::import(new PetugasImport($this->kegiatan_id), $this->fileImport);


        //     // Reset file setelah impor
        //     $this->reset(['fileImport', 'kegiatan_id', 'wilayah_terkecil_type_id']);


        //     // Kirim notifikasi berhasil
        //     $this->alert('success', 'Sukses!', [
        //         'position' => 'center',
        //         'timer' => 3000,
        //         'toast' => true,
        //         'text' => 'Data petugas berhasil diimpor!',
        //     ]);
        // } catch (\Exception $e) {
        //     $this->alert('error', 'Error!', [
        //         'position' => 'center',
        //         'timer' => 3000,
        //         'toast' => true,
        //         'text' =>  $e->getMessage(), // Menyimpan error untuk ditampilkan,
        //     ]);
        // }
    }

    public $ppls_showeds;

    public function  showPPL($id)
    {
        $this->ppls_showeds = User::find($id)->ppl;
    }


    public function render()
    {
        return view('livewire.manajemen-petugas', [
            'kegiatans' => Kegiatan::all(),
            'wilayah_terkecil_types' => WilayahTerkecilType::all(),
            'users_kegiatans' => UsersKegiatan::paginate(10),
            'pmls' => User::where('role', 'pml')->paginate(10),
        ]);
    }
}
