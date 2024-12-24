<?php

namespace App\Livewire;

use App\Models\PetugasLocation;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB as FacadesDB;;

use Illuminate\Support\Facades\File;

use Livewire\Component;

class First extends Component
{
    public $selectedKodeKabkota = [];
    public $selectAllKodeKabkota = true;

    public $selectedKodeTim = []; // ini diambil 1 digit awal dari kolom kode_petugas
    public $selectAllKodeTim = true;

    public $selectedKodeKegiatan = [];
    public $selectAllKodeKegiatan = true;

    public $selectedPetugas = [];

    public $geojsonFilesNames = [];
    public $selectedKodeSls = [];

    public function updatedSelectAllKodeKegiatan()
    {
        if ($this->selectAllKodeKegiatan) {
            $this->selectedKodeKegiatan = PetugasLocation::select('kode_kegiatan')->distinct()->pluck('kode_kegiatan')->toArray();
        } else {
            $this->selectedKodeKegiatan = [];
        }
    }

    public function updatedSelectedKodeKegiatan()
    {
        // Ambil semua kode_kegiatan
        $allKodeKegiatan = PetugasLocation::select('kode_kegiatan')->distinct()->pluck('kode_kegiatan')->toArray();

        // Jika semua kode_kegiatan ada di selectedKodeKegiatan, maka selectAllKodeKegiatan = true, jika tidak maka false
        $this->selectAllKodeKegiatan = count($this->selectedKodeKegiatan) === count($allKodeKegiatan);
    }

    public function updatedSelectAllKodeKabkota()
    {
        if ($this->selectAllKodeKabkota) {
            $this->selectedKodeKabkota = PetugasLocation::select('kode_kabkota')->distinct()->pluck('kode_kabkota')->toArray();
        } else {
            $this->selectedKodeKabkota = [];
        }
    }

    public function updatedSelectedKodeKabkota()
    {
        // Ambil semua kode_kabkota
        $allKodeKabkota = PetugasLocation::select('kode_kabkota')->distinct()->pluck('kode_kabkota')->toArray();

        // Jika semua kode_kabkota ada di selectedKodeKabkota, maka selectAllKodeKabkota = true, jika tidak maka false
        $this->selectAllKodeKabkota = count($this->selectedKodeKabkota) === count($allKodeKabkota);
    }

    public function updatedSelectAllKodeTim()
    {
        if ($this->selectAllKodeTim) {
            $this->selectedKodeTim = PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
                ->distinct()
                ->pluck('digit')
                ->toArray();
        } else {
            $this->selectedKodeTim = [];
        }
    }

    public function updatedSelectedKodeTim()
    {
        // Ambil semua digit dari kolom kode_petugas
        $allKodeTim = PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
            ->distinct()
            ->pluck('digit')
            ->toArray();

        // Jika semua kode tim ada di selectedKodeTim, maka selectAllKodeTim = true, jika tidak maka false
        $this->selectAllKodeTim = count($this->selectedKodeTim) === count($allKodeTim);
    }

    public function getFilteredResults()
    {
        // Jika salah satu filter kosong, return koleksi kosong
        if (
            empty($this->selectedKodeKabkota) ||
            empty($this->selectedKodeTim) ||
            empty($this->selectedKodeKegiatan)
        ) {
            $this->selectedPetugas = [];
            $this->dispatch('updateMap', $this->selectedPetugas);
            return collect(); // Mengembalikan koleksi kosong
        }

        // Jika semua filter terisi, lanjutkan query
        $this->selectedPetugas = PetugasLocation::query()
            ->when($this->selectedKodeKabkota, function ($query) {
                $query->whereIn('kode_kabkota', $this->selectedKodeKabkota);
            })
            ->when($this->selectedKodeTim, function ($query) {
                $query->whereIn(FacadesDB::raw('LEFT(kode_petugas, 1)'), $this->selectedKodeTim);
            })
            ->when($this->selectedKodeKegiatan, function ($query) {
                $query->whereIn('kode_kegiatan', $this->selectedKodeKegiatan);
            })
            ->get();
        $this->dispatch('updateMap', $this->selectedPetugas);
        return PetugasLocation::query()
            ->when($this->selectedKodeKabkota, function ($query) {
                $query->whereIn('kode_kabkota', $this->selectedKodeKabkota);
            })
            ->when($this->selectedKodeTim, function ($query) {
                $query->whereIn(FacadesDB::raw('LEFT(kode_petugas, 1)'), $this->selectedKodeTim);
            })
            ->when($this->selectedKodeKegiatan, function ($query) {
                $query->whereIn('kode_kegiatan', $this->selectedKodeKegiatan);
            })
            ->get();
    }



    public function mount()
    {
        $this->selectedKodeKabkota = PetugasLocation::select('kode_kabkota')->distinct()->pluck('kode_kabkota')->toArray();
        $this->selectedKodeTim = PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
            ->distinct()
            ->pluck('digit')
            ->toArray();
        $this->selectedKodeKegiatan = PetugasLocation::select('kode_kegiatan')->distinct()->pluck('kode_kegiatan')->toArray();
        // $this->selectedPetugas = PetugasLocation::all();
        $this->getFilteredResults();
        $this->geojsonFilesNames = $this->getGeojsonFilesNames();
    }

    public function render()
    {
        // dd($this->all());
        return view('livewire.first', [
            'kode_kabkotas' => PetugasLocation::select('kode_kabkota')->distinct()->pluck('kode_kabkota'),
            'kode_tims' => PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
                ->distinct()
                ->pluck('digit'),
            'kode_kegiatans' => PetugasLocation::select('kode_kegiatan')->distinct()->pluck('kode_kegiatan'),
            'filteredResults' => $this->getFilteredResults(),
            'geojsonFilesNames' => $this->geojsonFilesNames,
        ]);
    }

    // public function dd()
    // {
    //     // dd($this->all());
    //     $this->dispatch('updateMapSls');
    // }



    // public function loadGeojson()
    // public function dd()
    // {
    // Tentukan path file berdasarkan kode wilayah
    // $filePath = "geojson/{$this->selectedKodeWilayah}.geojson";
    // $filePath = "geojson/final_sls_202313301.js";
    // // Cek apakah file ada
    // if (Storage::exists($filePath)) {
    //     // Ambil isi file
    //     // $this->geojsonData = Storage::get($filePath);
    // } else {
    //     $this->geojsonData = null; // Jika file tidak ditemukan
    // }

    // Emit event untuk JavaScript
    // $this->dispatch('geojsonLoaded', $this->geojsonData);
    // }

    public function getGeojsonFilesNames()
    {
        // Path folder geojson di dalam public
        $directoryPath = public_path('geojson');

        // Pastikan folder ada
        if (!File::exists($directoryPath)) {
            return []; // Jika folder tidak ditemukan
        }

        // Ambil daftar file di dalam folder
        $files = File::files($directoryPath);

        // Ambil hanya nama file (tanpa path lengkap)
        $fileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $files);

        return $fileNames;
    }

    // public function updatedSelectedKodeSls()
    // {
    //     // Tentukan path file berdasarkan kode wilayah
    //     $filePath = "geojson/{$this->selectedKodeSls}";

    //     // Cek apakah file ada
    //     if (Storage::exists($filePath)) {
    //         // Ambil isi file
    //         $this->geojsonData = Storage::get($filePath);
    //     } else {
    //         $this->geojsonData = null; // Jika file tidak ditemukan
    //     }

    //     // Emit event untuk JavaScript
    //     $this->dispatch('geojsonLoaded', $this->geojsonData);
    // }

    public function updatedSelectedKodeSls()
    {
        $this->dispatch('updateGeojsonLayers', $this->selectedKodeSls);
    }


    public $geojsonData = null;
    public function dd()
    {
        // Tentukan path file berdasarkan lokasi di folder public
        $filePath = public_path("geojson/final_sls_202313322.geojson");
        // Periksa apakah file ada
        if (file_exists($filePath)) {
            // Dapatkan URL file
            $geojsonUrl = asset("geojson/final_sls_202313322.geojson");
            // Emit event dengan URL
            $this->dispatch('geojsonLoaded', $geojsonUrl);
        } else {
            $this->dispatch('geojsonLoaded', null); // Jika file tidak ditemukan
        }
    }

    public function ddasli()
    {
        dd($this->all());
    }
}
