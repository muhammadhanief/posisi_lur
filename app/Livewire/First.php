<?php

namespace App\Livewire;

use App\Models\Kabkot;
use App\Models\Kecamatan;
use App\Models\Kegiatan;
use App\Models\PetugasLocation;
use App\Models\UsersKegiatan;
use App\Models\WilayahTerkecil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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

    // public function updatedSelectedKodeKegiatan()
    // {
    //     // Ambil semua kode_kegiatan
    //     $allKodeKegiatan = Kegiatan::pluck('id')->toArray();

    //     // Jika semua kode_kegiatan ada di selectedKodeKegiatan, maka selectAllKodeKegiatan = true, jika tidak maka false
    //     $this->selectAllKodeKegiatan = count($this->selectedKodeKegiatan) === count($allKodeKegiatan);

    //     // Untuk update model wilayahterkecil terpilih
    //     $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $this->selectedKodeKegiatan)
    //         ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
    //         ->get();

    //     // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
    //     $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

    //     // memanggil ke peta
    //     $this->coba();
    // }

    public function updatedSelectedKodeKegiatan()
    {
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

        // Memanggil ke peta
        $this->coba();
    }


    // public function updatedSelectAllKodeKabkota()
    // {
    //     if ($this->selectAllKodeKabkota) {
    //         $this->selectedKodeKabkota = Kabkot::pluck('kd_kabkot')->toArray();
    //     } else {
    //         $this->selectedKodeKabkota = [];
    //     }

    //     // Untuk update model wilayahterkecil terpilih
    //     $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $this->selectedKodeKegiatan)
    //         ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
    //         ->get();

    //     // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
    //     $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

    //     // memanggil ke peta
    //     $this->coba();
    // }

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

        // Memanggil ke peta
        $this->coba();
    }


    // public function updatedSelectedKodeKabkota()
    // {
    //     // Ambil semua kode_kabkota
    //     $allKodeKabkota = Kabkot::pluck('kd_kabkot')->toArray();

    //     // Jika semua kode_kabkota ada di selectedKodeKabkota, maka selectAllKodeKabkota = true, jika tidak maka false
    //     $this->selectAllKodeKabkota = count($this->selectedKodeKabkota) === count($allKodeKabkota);

    //     // Untuk update model wilayahterkecil terpilih
    //     $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $this->selectedKodeKegiatan)
    //         ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
    //         ->get();

    //     // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
    //     $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

    //     // memanggil ke peta
    //     $this->coba();
    // }

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

        // Untuk update model wilayahterkecil terpilih
        $this->selectedKodeWilayahTerkecilModel = UsersKegiatan::whereIn('kegiatan_id', $selectedKodeKegiatanArray)
            ->whereIn(DB::raw('SUBSTRING(kd_full, 3, 2)'), $this->selectedKodeKabkota)
            ->get();

        // Ambil nilai kd_full dan isi ke properti selectedKodeWilayahTerkecil
        $this->selectedKodeWilayahTerkecil = $this->selectedKodeWilayahTerkecilModel->pluck('kd_full')->toArray();

        // Memanggil ke peta
        $this->coba();
    }

    // public function updatedSelectAllKodeTim()
    // {
    //     if ($this->selectAllKodeTim) {
    //         $this->selectedKodeTim = PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
    //             ->distinct()
    //             ->pluck('digit')
    //             ->toArray();
    //     } else {
    //         $this->selectedKodeTim = [];
    //     }
    // }

    // public function updatedSelectedKodeTim()
    // {
    //     // Ambil semua digit dari kolom kode_petugas
    //     $allKodeTim = PetugasLocation::selectRaw('LEFT(kode_petugas, 1) as digit')
    //         ->distinct()
    //         ->pluck('digit')
    //         ->toArray();

    //     // Jika semua kode tim ada di selectedKodeTim, maka selectAllKodeTim = true, jika tidak maka false
    //     $this->selectAllKodeTim = count($this->selectedKodeTim) === count($allKodeTim);
    // }

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
        // Mengambil semua nilai kd_full dan menyimpannya dalam array
        $wilayah_terkecils = $this->selectedKodeWilayahTerkecil;

        // Cek apakah array kosong
        if (empty($wilayah_terkecils)) {
            // Jika kosong, lakukan sesuatu, misalnya keluar dari fungsi atau kirim data kosong
            $this->dispatch('geojsonLoaded', [
                'type' => 'FeatureCollection',
                'features' => []
            ]);
            return;
        }

        // yang murni biasa
        // Query untuk mengambil data berdasarkan ID SLS
        // $geojson = DB::select(
        //     "
        //     SELECT jsonb_build_object(
        //         'type', 'Feature',
        //         'geometry', ST_AsGeoJSON(wkb_geometry)::jsonb,
        //         'properties', to_jsonb(peta) - 'wkb_geometry'
        //     ) AS geojson
        //     FROM peta
        //     WHERE idsls IN (" . implode(',', array_fill(0, count($wilayah_terkecils), '?')) . ")",
        //     $wilayah_terkecils
        // );

        // yang nampilin user_id kegiatan
        // $geojson = DB::select(
        //     "
        //     SELECT jsonb_build_object(
        //         'type', 'Feature',
        //         'geometry', ST_AsGeoJSON(wkb_geometry)::jsonb,
        //         'properties', to_jsonb(peta) - 'wkb_geometry' || jsonb_build_object('user_id', users_kegiatans.user_id)
        //     ) AS geojson
        //     FROM peta
        //     LEFT JOIN users_kegiatans ON users_kegiatans.kd_full = peta.idsls
        //     WHERE idsls IN (" . implode(',', array_fill(0, count($wilayah_terkecils), '?')) . ")",
        //     $wilayah_terkecils
        // );

        // yang udahs ama petugas
        $geojson = DB::select(
            "
            SELECT jsonb_build_object(
                'type', 'Feature',
                'geometry', ST_AsGeoJSON(wkb_geometry)::jsonb,
                'properties', to_jsonb(peta) - 'wkb_geometry' || jsonb_build_object('name', users.name)
            ) AS geojson
            FROM peta
            LEFT JOIN users_kegiatans ON users_kegiatans.kd_full = peta.idsls
            LEFT JOIN users ON users.id = users_kegiatans.user_id
            WHERE idsls IN (" . implode(',', array_fill(0, count($wilayah_terkecils), '?')) . ")",
            $wilayah_terkecils
        );



        // Ubah hasil query menjadi array GeoJSON
        $features = array_map(fn($row) => json_decode($row->geojson, true), $geojson);

        // Bungkus dalam GeoJSON FeatureCollection
        $featureCollection = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
        // dd($featureCollection);

        $this->dispatch('geojsonLoaded', $featureCollection);
    }


    public function updatedSelectedKodeSls()
    {
        // dd($this->selectedKodeSls);
        $this->dispatch('updateGeojsonLayers', $this->selectedKodeSls);
        // $this->dispatch('updateGeojsonLayers', ['filtered_sls.geojson']);
    }

    // coba tampilkan hanya peta ybs
    public function getPolygonsForAllUsers()
    {
        // Ambil daftar semua kd_full dari database
        $kdFullList = WilayahTerkecil::where('kd_kabkot', 72)->get();
        dd($kdFullList);
        // Baca file GeoJSON
        $geoJsonData = File::get(public_path('geojson/76.geojson'));
        if (!File::exists(public_path('geojson/coba.geojson'))) {
            dd('File tidak ditemukan');
        }
        // else {
        //     dd('File ditemukan');
        // }

        $polygons = json_decode($geoJsonData, true); // Decode file GeoJSON


        // Filter poligon yang memiliki kd_full yang cocok dengan kd_full di database
        $filteredPolygons = array_filter($polygons['features'], function ($polygon) use ($kdFullList) {
            return in_array($polygon['properties']['idsls'], $kdFullList);
        });

        dd($filteredPolygons);
        // $this->dispatch('updateGeojsonLayers', ['final_sls_202313374.geojson']);
        // Kirim data poligon yang terfilter ke frontend
        // return response()->json(['features' => array_values($filteredPolygons)]);
        // dd(['filtered_sls.geojson']);
        // $this->dispatch('updateGeojsonLayers', ['filtered_sls.geojson']);

        // Baca file GeoJSON
        // $geoJsonData = File::get(public_path('geojson/final_sls_202313374.geojson'));
        // $geoJsonData = File::get(public_path('geojson/coba.geojson'));
        // $polygons = json_decode($geoJsonData, true); // Decode file GeoJSON

        // // Gunakan generator untuk memproses data dalam batch
        // $filteredPolygons = [];
        // foreach ($polygons['features'] as $polygon) {
        //     if (in_array($polygon['properties']['idsls'], $kdFullList)) {
        //         $filteredPolygons[] = $polygon;
        //     }
        // }

        // dd($filteredPolygons);
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

        ]);
    }



    public function dd()
    {
        dd($this->all());
    }
}
