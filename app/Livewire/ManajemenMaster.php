<?php

namespace App\Livewire;

use App\Imports\WilayahTerkecilImport;
use App\Models\Kegiatan;
use App\Models\WilayahTerkecil;
use App\Models\WilayahTerkecilType;
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
        $this->validate([
            'fileImport' => 'required|mimes:xlsx',
            'wilayah_terkecil_type_id' => 'required|not_in:'
        ]);
        // dd($this->fileImport);
        $import = Excel::import(new WilayahTerkecilImport($this->wilayah_terkecil_type_id), $this->fileImport);

        $this->reset(['fileImport', 'wilayah_terkecil_type_id']);
        // if ($import) {
        //     dd($import);
        // $this->alert('error', 'Gagal!', [
        //     'position' => 'center',
        //     'timer' => 3000,
        //     'toast' => true,
        //     'text' => 'Master Wilayah Gagal Ditambahkan!',
        // ]);
        // } else {
        // dd($import);
        // $this->alert('success', 'Sukses!', [
        //     'position' => 'center',
        //     'timer' => 3000,
        //     'toast' => true,
        //     'text' => 'Master Wilayah Sukses Ditambahkan!',
        // ]);
        // }
        $this->alert('success', 'Sukses!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Master Wilayah Sukses Ditambahkan!',
        ]);
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
        $this->isCreateNewKegiatanOpen = false;

        // Tampilkan SweetAlert setelah berhasil
        $this->alert('success', 'Sukses!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Master Kegiatan Sukses Ditambahkan!',
        ]);
    }


    public $isCreateNewKegiatanOpen = false;
    public function showCreateNewKegiatan()
    {
        $this->isCreateNewKegiatanOpen = true;
    }

    public function cancelNewKegiatan()
    {
        $this->reset(['newKegiatanName', 'newKegiatanDesc']);
        $this->isCreateNewKegiatanOpen = false;
    }

    public function render()
    {
        return view('livewire.manajemen-master', [
            'wilayah_terkecil_types' => WilayahTerkecilType::all(),
            'wilayah_terkecils' => WilayahTerkecil::paginate(10, ['*'], 'firstTablePage'),
            'kegiatans' => Kegiatan::paginate(10, ['*'], 'secondTablePage'),
        ]);
    }
}
