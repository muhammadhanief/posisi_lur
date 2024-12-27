<?php

namespace App\Exports;

use App\Models\WilayahTerkecil;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplatePlotPetugasExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $wilayah_terkecil_type_id;

    public function __construct($wilayah_terkecil_type_id)
    {
        $this->wilayah_terkecil_type_id = $wilayah_terkecil_type_id;
    }

    public function collection()
    {
        // Misalnya, Anda ingin meng-export data berdasarkan wilayah_terkecil_type_id
        // Gantilah dengan query sesuai dengan kebutuhan Anda
        return WilayahTerkecil::where('wilayah_terkecil_type_id', $this->wilayah_terkecil_type_id)
            ->get(['kd_provinsi', 'kd_kabkot', 'kd_kecamatan', 'kd_desa', 'kd_wilayah_terkecil', 'kd_full', 'nm_wilayah_terkecil']);  // Gantilah dengan kolom yang relevan
    }

    public function headings(): array
    {
        return [
            'kode_provinsi',
            'kode_kabupatenkota',
            'kode_kecamatan',
            'kode_desakelurahan',
            'kode_wilayah_terkecil',
            'kode_full',
            'nama_wilayah_terkecil',
            'kode_ppl',
            'nama_ppl',
            'jk_ppl_l_atau_k',
            'no_hp_ppl',
            'kode_pml',
            'nama_pml',
            'jk_pml_l_atau_k',
            'no_hp_pml',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@',
            'B' => '@',
            'C' => '@',
            'D' => '@',
            'E' => '@',
            'F' => '@',
            'G' => '@',
            'H' => '@',
            'I' => '@',
            'J' => '@',
            'K' => '@',
            'L' => '@',
            'M' => '@',
            'N' => '@',
            'O' => '@',
        ];
    }
}
