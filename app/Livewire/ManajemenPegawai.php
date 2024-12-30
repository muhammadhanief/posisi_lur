<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenPegawai extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.manajemen-pegawai', [
            'users_pegawais' => User::whereIn('role', ['pegawai,ojk'])->paginate(10),
        ]);
    }
}
