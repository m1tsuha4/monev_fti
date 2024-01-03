<?php

namespace Database\Seeders;

use App\Models\JenisSoalUjian;
use Illuminate\Database\Seeder;

class FormSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents('form_validasi_soalujian.json');
        $data = json_decode($jsonData, true);

        foreach ($data as $user) {
            JenisSoalUjian::create([
                'id_form_validasisoal' => $user['id_form_validasisoal'],
                'kriteria_penilaian' => $user['kriteria_penilaian'],
                'point_penilaian' => $user['point_penilaian'],
            ]);
        }
    }
}
