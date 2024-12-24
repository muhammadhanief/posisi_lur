<?php

namespace App\Imports;

use App\Models\Desa;
use App\Models\Kabkot;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\WilayahTerkecil;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class WilayahTerkecilImport implements ToModel, WithHeadingRow
{
    protected $wilayah_terkecil_type_id;

    public function __construct($wilayah_terkecil_type_id)
    {
        $this->wilayah_terkecil_type_id = $wilayah_terkecil_type_id;
    }

    public function model(array $row)
    {
        DB::beginTransaction(); // Memulai transaksi
        try {
            // Proses data seperti biasa
            Provinsi::firstOrCreate(
                ['kd_provinsi' => trim($row['kode_provinsi'])],
                ['nm_provinsi' => trim($row['provinsi'])]
            );

            Kabkot::firstOrCreate(
                [
                    'kd_provinsi' => trim($row['kode_provinsi']),
                    'kd_kabkot' => trim($row['kode_kabupatenkota'])
                ],
                [
                    'nm_kabkot' => trim($row['kabupatenkota']),
                ]
            );

            Kecamatan::firstOrCreate(
                [
                    'kd_kabkot' => trim($row['kode_kabupatenkota']),
                    'kd_kecamatan' => trim($row['kode_kecamatan']),
                ],
                [
                    'kd_provinsi' => trim($row['kode_provinsi']),
                    'nm_kecamatan' => trim($row['kecamatan']),
                ]
            );

            Desa::firstOrCreate(
                [
                    'kd_kecamatan' => trim($row['kode_kecamatan']),
                    'kd_desa' => trim($row['kode_desakelurahan']),
                ],
                [
                    'kd_provinsi' => trim($row['kode_provinsi']),
                    'kd_kabkot' => trim($row['kode_kabupatenkota']),
                    'nm_desa' => trim($row['desakelurahan']),
                ]
            );

            $kd_full = trim($row['kode_provinsi']) .
                trim($row['kode_kabupatenkota']) .
                trim($row['kode_kecamatan']) .
                trim($row['kode_desakelurahan']) .
                trim($row['kode_wilayahterkecil']);

            WilayahTerkecil::firstOrCreate(
                [
                    'kd_kecamatan' => trim($row['kode_kecamatan']),
                    'kd_desa' => trim($row['kode_desakelurahan']),
                    'kd_wilayah_terkecil' => trim($row['kode_wilayahterkecil']),
                ],
                [
                    'kd_provinsi' => trim($row['kode_provinsi']),
                    'kd_kabkot' => trim($row['kode_kabupatenkota']),
                    'kd_full' => $kd_full,
                    'nm_wilayah_terkecil' => trim($row['nama_wilayahterkecil']),
                    'wilayah_terkecil_type_id' => $this->wilayah_terkecil_type_id,
                ]
            );

            DB::commit(); // Commit transaksi jika semua sukses
            return null; // Kembalikan null jika sukses
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika ada error
            Log::error("Failed to process row: ", ['row' => $row, 'error' => $e->getMessage()]);
            throw $e; // Opsional: Lempar ulang error jika ingin berhenti sepenuhnya
            return $e; // Kembalikan error jika ingin melanjutkan proses
        }
    }
}
