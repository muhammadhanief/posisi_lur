<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Kabkot;
use App\Models\Kecamatan;
use App\Models\Kegiatan;
use App\Models\PetugasLocation;
use App\Models\UsersKegiatan;
use App\Models\WilayahTerkecil;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\File;

use Livewire\Component;
use Livewire\WithPagination;

class First extends Component
{
    use WithPagination;

    public $selectedKodeKabkota = [];
    public $selectAllKodeKabkota = false;

    // public $selectedKodeKegiatan = [];
    public $selectedKodeKegiatan; // Tidak perlu array
    public $selectAllKodeKegiatan = false;

    public $selectedPetugas = [];

    // public $selectedKodeSls = [];

    public $selectedKodeWilayahTerkecilModel;
    public $selectedKodeWilayahTerkecil = [];

    public function updatedSelectAllKodeKegiatan()
    {
        if ($this->selectAllKodeKegiatan) {
            $this->selectedKodeKegiatan = Kegiatan::pluck('id')->toArray();
        } else {
            $this->selectedKodeKegiatan = [];
        }

        // Untuk update model wilayahterkecil terpilih
        $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $this->selectedKodeKegiatan)
            ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
            ->get();

        // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
        $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

        // memanggil ke peta
        $this->coba();
    }

    public function isAllChecked()
    {
        // Pastikan kedua properti tidak null
        if ($this->selectedKodeWilayahTerkecil === null || $this->selectedKodeKabkota === null) {
            return false; // Tidak memenuhi syarat
        }
        return true; // Semua syarat terpenuhi
    }


    public function updatedSelectedKodeKegiatan()
    {
        $this->isAllChecked();
        // Ambil semua kode_kegiatan
        $allKodeKegiatan = Kegiatan::pluck('id')->toArray();

        // Jika selectedKodeKegiatan adalah string (karena radio button), ubah menjadi array
        $selectedKodeKegiatanArray = is_array($this->selectedKodeKegiatan) ? $this->selectedKodeKegiatan : [$this->selectedKodeKegiatan];

        // Periksa apakah semua kode_kegiatan ada di selectedKodeKegiatan
        $this->selectAllKodeKegiatan = count($selectedKodeKegiatanArray) === count($allKodeKegiatan);

        // Update model wilayahterkecil terpilih
        $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $selectedKodeKegiatanArray)
            ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
            ->get();

        // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
        $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

        // Periksa apakah semua syarat terpenuhi
        if (!$this->isAllChecked()) {
            return; // Hentikan eksekusi jika syarat tidak terpenuhi
        }

        // Memanggil ke peta
        $this->coba();
    }


    public function updatedSelectAllKodeKabkota()
    {
        if ($this->selectAllKodeKabkota) {
            $this->selectedKodeKabkota = Kabkot::pluck('kd_kabkot')->toArray();
        } else {
            $this->selectedKodeKabkota = [];
        }

        // Pastikan selectedKodeKegiatan berupa array
        $selectedKodeKegiatanArray = is_array($this->selectedKodeKegiatan) ? $this->selectedKodeKegiatan : [$this->selectedKodeKegiatan];

        // Untuk update model wilayahterkecil terpilih
        $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $selectedKodeKegiatanArray)
            ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
            ->get();

        // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
        $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

        // Periksa apakah semua syarat terpenuhi
        if (!$this->isAllChecked()) {
            return; // Hentikan eksekusi jika syarat tidak terpenuhi
        }

        $this->updatedSelectedKodeKabkota();
    }


    public function updatedSelectedKodeKabkota()
    {
        // Pastikan selectedKodeKabkota adalah array
        $this->selectedKodeKabkota = is_array($this->selectedKodeKabkota) ? $this->selectedKodeKabkota : [$this->selectedKodeKabkota];

        // Ambil semua kode_kabkota
        $allKodeKabkota = Kabkot::pluck('kd_kabkot')->toArray();

        // Jika semua kode_kabkota ada di selectedKodeKabkota, maka selectAllKodeKabkota = true, jika tidak maka false
        $this->selectAllKodeKabkota = count($this->selectedKodeKabkota) === count($allKodeKabkota);

        // Pastikan selectedKodeKegiatan adalah array
        $selectedKodeKegiatanArray = is_array($this->selectedKodeKegiatan) ? $this->selectedKodeKegiatan : [$this->selectedKodeKegiatan];

        // Ambil wilayah inside_area: Wilayah dengan is_in_area = true
        $insideArea = UsersKegiatan::whereIn('kegiatan_id', $selectedKodeKegiatanArray)
            ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
            ->whereHas('activities', function ($query) {
                $query->where('is_in_area', true);
            })
            ->pluck('kd_full')
            ->toArray();

        // Ambil wilayah outside_area: Wilayah tanpa memeriksa tabel activities
        $outsideArea = UsersKegiatan::whereIn('kegiatan_id', $selectedKodeKegiatanArray)
            ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
            ->whereDoesntHave('activities') // Wilayah tanpa aktivitas
            ->orWhere(function ($query) use ($selectedKodeKegiatanArray) {
                $query->whereIn('kegiatan_id', $selectedKodeKegiatanArray)
                    ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota);
            })
            ->pluck('kd_full')
            ->toArray();

        // Gabungkan hasil ke properti selectedKodeWilayahTerkecil
        $this->selectedKodeWilayahTerkecil = [
            'inside_area' => $insideArea,
            'outside_area' => $outsideArea,
        ];

        // Periksa apakah semua syarat terpenuhi
        if (!$this->isAllChecked()) {
            return; // Hentikan eksekusi jika syarat tidak terpenuhi
        }

        // Memanggil ke peta
        $this->coba();
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
                $query->whereIn(DB::raw('LEFT(kode_petugas, 1)'), $this->selectedKodeTim);
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
                $query->whereIn(DB::raw('LEFT(kode_petugas, 1)'), $this->selectedKodeTim);
            })
            ->when($this->selectedKodeKegiatan, function ($query) {
                $query->whereIn('kode_kegiatan', $this->selectedKodeKegiatan);
            })
            ->get();
    }

    public function coba()
    {
        // Mengambil nilai inside_area dan outside_area
        $insideArea = $this->selectedKodeWilayahTerkecil['inside_area'] ?? [];
        $outsideArea = $this->selectedKodeWilayahTerkecil['outside_area'] ?? [];

        // dd($insideArea, $outsideArea, 'bro');

        // Cek apakah array kosong
        if (empty($insideArea) && empty($outsideArea)) {
            // Jika kosong, kirim data GeoJSON kosong
            $this->dispatch('geojsonLoaded', [
                'type' => 'FeatureCollection',
                'features' => []
            ]);
            return;
        }

        // Ambil GeoJSON untuk area inside
        $geojsonInside = [];
        if (!empty($insideArea)) {
            $geojsonInside = DB::select(
                "
            SELECT jsonb_build_object(
                'type', 'Feature',
                'geometry', ST_AsGeoJSON(wkb_geometry)::jsonb,
                'properties', to_jsonb(peta) - 'wkb_geometry' || jsonb_build_object('name', users.name, 'area_type', 'inside', 'idsls', idsls)
            ) AS geojson
            FROM peta
            LEFT JOIN users_kegiatans ON users_kegiatans.kd_full = peta.idsls
            LEFT JOIN users ON users.id = users_kegiatans.user_id
            WHERE idsls IN (" . implode(',', array_fill(0, count($insideArea), '?')) . ")",
                $insideArea
            );
        }

        // Ambil GeoJSON untuk area outside
        $geojsonOutside = [];
        if (!empty($outsideArea)) {
            $geojsonOutside = DB::select(
                "
            SELECT jsonb_build_object(
                'type', 'Feature',
                'geometry', ST_AsGeoJSON(wkb_geometry)::jsonb,
                'properties', to_jsonb(peta) - 'wkb_geometry' || jsonb_build_object('name', users.name, 'area_type', 'outside', 'idsls', idsls)
            ) AS geojson
            FROM peta
            LEFT JOIN users_kegiatans ON users_kegiatans.kd_full = peta.idsls
            LEFT JOIN users ON users.id = users_kegiatans.user_id
            WHERE idsls IN (" . implode(',', array_fill(0, count($outsideArea), '?')) . ")",
                $outsideArea
            );
        }

        // Gabungkan hasil GeoJSON dari inside dan outside
        $geojson = array_merge(
            array_map(fn($row) => json_decode($row->geojson, true), $geojsonInside),
            array_map(fn($row) => json_decode($row->geojson, true), $geojsonOutside)
        );


        // Bungkus dalam GeoJSON FeatureCollection
        $featureCollection = [
            'type' => 'FeatureCollection',
            'features' => $geojson,
        ];
        $this->dispatch('geojsonLoaded', $featureCollection);
        // $this->dispatch('odading');
        $this->markerPetugas();
    }


    public function markerPetugas()
    {
        $activities = Activity::with('usersKegiatan.user') // Memuat relasi sampai ke tabel User
            ->select('id', 'users_kegiatan_id', 'lat', 'lng', 'created_at')
            // ->where('is_in_area', true) // Menambahkan kondisi untuk is_in_area yang true
            ->whereRaw('id IN (SELECT MAX(id) FROM activities GROUP BY users_kegiatan_id)')
            ->get();

        $data = $activities->map(function ($activity) {
            return [
                'lat' => $activity->lat,
                'lng' => $activity->lng,
                'name' => $activity->usersKegiatan->user->name ?? 'Tidak diketahui', // Ambil nama user
            ];
        });
        // dd($data);

        $this->dispatch('updateMapNya', $data);
    }



    public function mount()
    {

        // Ambil data tanpa paginate
        $this->selectedKodeWilayahTerkecilModel = collect(); // Mengatur ke collection kosong


        $this->selectedKodeKabkota = PetugasLocation::select('kode_kabkota')->distinct()->pluck('kode_kabkota')->toArray();
        // $this->selectedKodeTim = PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
        //     ->distinct()
        //     ->pluck('digit')
        //     ->toArray();
        $this->selectedKodeKegiatan = PetugasLocation::select('kode_kegiatan')->distinct()->pluck('kode_kegiatan')->toArray();
        // $this->selectedPetugas = PetugasLocation::all();
        $this->getFilteredResults();
    }

    public function render()
    {
        return view('livewire.first', [
            'kegiatans' => Kegiatan::all(),
            'kode_kabkotas' => Kabkot::all(),
            'kode_kecamatans' => Kecamatan::all(),
            'kode_tims' => PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
                ->distinct()
                ->pluck('digit'),
            'kode_kegiatans' => PetugasLocation::select('kode_kegiatan')->distinct()->pluck('kode_kegiatan'),
            'filteredResults' => $this->getFilteredResults(),
            'activities' => Activity::paginate(10),
        ]);
    }



    public function dd()
    {
        dd($this->all());
    }
}
