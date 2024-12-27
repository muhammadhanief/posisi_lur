<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UsersKegiatan;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithValidation;

class PetugasImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $kegiatan_id;

    public function __construct($kegiatan_id)
    {
        $this->kegiatan_id = $kegiatan_id;
    }

    public function model(array $row)
    {
        try {
            DB::beginTransaction();

            // Proses data PML
            $str_random = Str::random(8);
            $pml = User::firstOrCreate(
                ['hp' => $row['no_hp_pml']],
                [
                    'name' => $row['nama_pml'],
                    'password' => ($str_random),
                    'password_not_hashed' => $str_random,
                    'role' => 'pml',
                    'jk' => $row['jk_pml_l_atau_k'],
                    'is_paired' => true,
                ]
            );


            // Proses data PPL
            $str_random2 = Str::random(8);
            $ppl = User::firstOrCreate(
                ['hp' => $row['no_hp_ppl']],
                [
                    'name' => $row['nama_ppl'],
                    'password' => ($str_random2),
                    'password_not_hashed' => $str_random2,
                    'role' => 'ppl',
                    'jk' => $row['jk_ppl_l_atau_k'],
                    'is_paired' => true,
                ]
            );

            // Validasi keberadaan kd_full
            $kdFullExists = DB::table('wilayah_terkecils')->where('kd_full', $row['kode_full'])->exists();
            if (!$kdFullExists) {
                throw new Exception("Kode wilayah '{$row['kode_full']}' tidak ditemukan.");
            }

            // Validasi kombinasi kegiatan_id dan kd_full
            $existingRecord = UsersKegiatan::where('kegiatan_id', $this->kegiatan_id)
                ->where('kd_full', $row['kode_full'])
                ->first();

            if ($existingRecord && $existingRecord->user_id !== $ppl->id) {
                throw new Exception("Kombinasi kegiatan ID '{$this->kegiatan_id}' dan kode wilayah '{$row['kode_full']}' sudah dimiliki oleh pengguna lain.");
            }

            // Tambahkan data ke tabel users_kegiatan
            $usersKegiatan = UsersKegiatan::firstOrCreate(
                [
                    'user_id' => $ppl->id,
                    'kegiatan_id' => $this->kegiatan_id,
                    'kd_full' => $row['kode_full'],
                ],
                [
                    'hp_pml' => $row['no_hp_pml'],
                    'petugas_id' => $row['kode_ppl'],
                    'tahun' => now()->year,
                ]
            );

            DB::commit();
            return $usersKegiatan;
        } catch (Exception $e) {
            DB::rollBack();

            // Logging error
            Log::error("Gagal memproses data: {$e->getMessage()}", [
                'row' => $row,
            ]);

            throw $e; // Melempar ulang untuk ditangani di luar
        }
    }


    public function rules(): array
    {
        return [
            'no_hp_pml'         => 'required',
            'nama_pml'          => 'required',
            'jk_pml_l_atau_k'   => 'required', // Misalnya, validasi L atau K
            'no_hp_ppl'         => 'required',
            'nama_ppl'          => 'required',
            'jk_ppl_l_atau_k'   => 'required', // Misalnya, validasi L atau K
            'kode_full'         => 'required',
            'kode_ppl'          => 'required',
        ];
    }
}
