<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents('dosen.json');
        $data = json_decode($jsonData, true);

        foreach ($data as $user) {
            User::create([
                'nip_dosen' => $user['nip_dosen'],
                'kode_prodi' => $user['kode_prodi'],
                'nama_dosen' => $user['nama_dosen'],
                'jabatan' => $user['jabatan'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']), // Hash the password before saving to the database
                'status' => $user['status'],
            ]);
        }
    }
}
