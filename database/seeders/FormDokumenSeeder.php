<?php

namespace Database\Seeders;

use App\Models\JenisKelengkapanDokumen;
use App\Models\JenisSoalUjian;
use Illuminate\Database\Seeder;

class FormDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents('form_kelengkapan_dokumen.json');
        $data = json_decode($jsonData, true);

        foreach ($data as $user) {
            JenisKelengkapanDokumen::create([
                'id_jenis_kelengkapan_dokumen' => $user['id_jenis_kelengkapan dokumen'],
                'tipe_penilaian' => $user['tipe_penilaian'],
                'point_penilaian_kelengkapan_dokumen' => $user['point_penilaian_kelengkapan_dokumen'],
            ]);
        }
    }
}
