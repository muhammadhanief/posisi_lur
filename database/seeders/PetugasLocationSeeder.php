<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PetugasLocation;
use Carbon\Carbon;

class PetugasLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Daftar kode kegiatan dan kode kabupaten/kota yang berbeda
        $kodeKegiatan = ['Sak0324', 'SSN0824', 'Ubinan'];
        $kodeKabkota = ['3321', '3322', '3323'];

        // Timestamp yang tetap
        $timestamp = Carbon::createFromFormat('d/m/Y H:i', '09/12/2024 20:38')->toDateTimeString();


        // Data petugas acak
        $petugasData = [
            ['1001', 'Dian', -7.048929, 110.492233],
            ['1002', 'Dwi Noviastuti', -7.051947, 110.499730],
            ['1003', 'Edsel', -7.057190, 110.496424],
            ['1004', 'Edric', -7.052855, 110.494151],
            ['1005', 'Enrico', -7.051917, 110.491377],
            ['2001', 'Betta', -7.030532, 110.494542],
            ['2002', 'Noranita', -7.027402, 110.499036],
            ['2003', 'Wiwin', -7.029509, 110.507953],
            ['2004', 'Kunarwati', -7.039802, 110.494940],
            ['2005', 'Ratri', -7.039306, 110.490472],
            ['3001', 'Niluh', -7.046756, 110.498985],
            ['3002', 'Rangga', -7.044384, 110.508337],
            ['3003', 'Suto', -7.041887, 110.495756],
            ['3004', 'Noyo', -7.044842, 110.490556],
            ['3005', 'Genggong', -7.050335, 110.496595],
            ['4001', 'Sabdo', -7.039424, 110.511369],
            ['4002', 'Palon', -7.039552, 110.514845],
            ['4003', 'Maheso', -7.041064, 110.513558],
            ['4004', 'Jenar', -7.042629, 110.515403],
            ['4005', 'Pengalasan', -7.040382, 110.512989],
            ['5001', 'Pasingsingan', -7.089133, 110.498310],
            ['5002', 'Lowo Ijo', -7.087013, 110.484300],
            ['5003', 'Simo', -7.081137, 110.497241],
            ['5004', 'Rodro', -7.087618, 110.489000],
        ];

        // Menyimpan data ke dalam database dengan kode kegiatan dan kabupaten/kota acak
        foreach ($petugasData as $data) {
            PetugasLocation::create([
                'kode_kabkota' => $kodeKabkota[array_rand($kodeKabkota)],  // Pilih acak kode kabupaten/kota
                'kode_kegiatan' => $kodeKegiatan[array_rand($kodeKegiatan)],  // Pilih acak kode kegiatan
                'kode_petugas' => $data[0],
                'nama_petugas' => $data[1],
                'timestamp' => $timestamp,
                'latitude' => $data[2],
                'longitude' => $data[3],
            ]);
        }
    }
}