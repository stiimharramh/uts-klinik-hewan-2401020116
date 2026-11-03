<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlinikHewanSeeder extends Seeder
{
    /**
     * Mengisi data awal jenis hewan dan pasien
     */
    public function run(): void
    {
        // Memasukkan jenis hewan
        DB::table('jenis_hewan')->insert([
            ['nama_jenis' => 'Kucing'],
            ['nama_jenis' => 'Anjing'],
        ]);

        // Mengambil ID jenis hewan
        $kucing = DB::table('jenis_hewan')
                    ->where('nama_jenis', 'Kucing')
                    ->value('id');

        $anjing = DB::table('jenis_hewan')
                    ->where('nama_jenis', 'Anjing')
                    ->value('id');

        // Memasukkan data pasien hewan
        DB::table('pasien_hewan')->insert([
            [
                'kode_pasien' => 'PH00000001',
                'nama_hewan' => 'Milo',
                'nomor_rekam' => 'RMH-0001',
                'usia_tahun' => 3,
                'jenis_hewan_id' => $kucing,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_pasien' => 'PH00000002',
                'nama_hewan' => 'Bruno',
                'nomor_rekam' => 'RMH-0002',
                'usia_tahun' => 5,
                'jenis_hewan_id' => $anjing,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_pasien' => 'PH00000003',
                'nama_hewan' => 'Luna',
                'nomor_rekam' => 'RMH-0003',
                'usia_tahun' => 2,
                'jenis_hewan_id' => $kucing,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
