<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlamatSeeder extends Seeder
{
    public function run()
    {
        $provinsis = [
            'Jawa Barat' => [
                'Bandung' => [
                    'Coblong' => ['Dago', 'Lebak Gede', 'Sekeloa'],
                    'Cicendo' => ['Pasirkaliki', 'Sukajadi'],
                ],
                'Bogor' => [
                    'Bogor Tengah' => ['Pabaton', 'Cibogor'],
                    'Bogor Utara' => ['Tegal Gundil', 'Cimahpar'],
                ],
            ],
            'Jawa Tengah' => [
                'Semarang' => [
                    'Tembalang' => ['Sambiroto', 'Meteseh'],
                    'Banyumanik' => ['Padangsari', 'Sumurboto'],
                ],
                'Surakarta' => [
                    'Laweyan' => ['Pajang', 'Penumping'],
                    'Serengan' => ['Kemlayan', 'Serengan'],
                ],
            ],
        ];

        foreach ($provinsis as $provinsiNama => $kotas) {
            $provinsiId = DB::table('provinsis')->insertGetId([
                'nama' => $provinsiNama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($kotas as $kotaNama => $kecamatans) {
                $kotaId = DB::table('kotas')->insertGetId([
                    'provinsi_id' => $provinsiId,
                    'nama' => $kotaNama,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($kecamatans as $kecamatanNama => $desas) {
                    $kecamatanId = DB::table('kecamatans')->insertGetId([
                        'kota_id' => $kotaId,
                        'nama' => $kecamatanNama,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    foreach ($desas as $desaNama) {
                        DB::table('desas')->insert([
                            'kecamatan_id' => $kecamatanId,
                            'nama' => $desaNama,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}