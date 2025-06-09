<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisAsuransiSeeder extends Seeder
{
    public function run()
    {
        $jenis = [
            'BPJS Kesehatan',
            'Asuransi Swasta',
            'Asuransi Perusahaan',
            'Kartu Indonesia Sehat',
            'Tidak Ada'
        ];

        foreach ($jenis as $nama) {
            DB::table('jenis_asuransis')->insert([
                'nama' => $nama,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}