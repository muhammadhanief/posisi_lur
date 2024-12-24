<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kegiatan;
use App\Models\WilayahTerkecilType;
use Livewire\Attributes\Validate;

class ManajemenPetugas extends Component
{
    #[Validate('required|not_in:')]
    public $kegiatan_id;
    #[Validate('required|not_in:')]
    public $wilayah_terkecil_type_id;

    public function dd()
    {
        dd($this->all());
    }

    public function render()
    {
        return view('livewire.manajemen-petugas', [
            'kegiatans' => Kegiatan::all(),
            'wilayah_terkecil_types' => WilayahTerkecilType::all(),
        ]);
    }
}
