<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents('matakuliah.json');
        $data = json_decode($jsonData, true);

        foreach ($data as $user) {
            Matakuliah::create([
                'kode_matakuliah' => $user['kode_matakuliah'],
                'tahun_kurikulum' => $user['tahun_kurikulum'],
                'nama_matakuliah' => $user['nama_matakuliah'],
                'jumlah_kelas' => $user['jumlah_kelas'],
                'kategori_matakuliah' => $user['kategori_matakuliah'],
                'estimasi_mahasiswa' => $user['estimasi_mahasiswa'],
                'semester' => $user['semester'],
                'jumlah_sks' => $user['jumlah_sks'],
            ]);
        }
    }
}
