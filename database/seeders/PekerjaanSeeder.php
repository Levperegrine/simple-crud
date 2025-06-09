<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    public function run()
    {
        $pekerjaan = [
            'Petani',
            'Guru',
            'Dokter',
            'Pegawai Negeri',
            'Wiraswasta',
            'Pelajar',
            'Mahasiswa',
            'Pengangguran',
            'Pensiunan'
        ];

        foreach ($pekerjaan as $nama) {
            DB::table('pekerjaans')->insert([
                'nama' => $nama,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}