<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents('prodis.json');
        $data = json_decode($jsonData, true);

        foreach ($data as $user) {
            Prodi::create([
                'kode_prodi' => $user['kode_prodi'],
                'nama_prodi' => $user['nama_prodi'],
                'jenjang_pendidikan' => $user['jenjang_pendidikan'],
            ]);
        }
    }
}
