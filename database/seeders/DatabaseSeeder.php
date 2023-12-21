<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role = [
            [
                'nip' => '196211221989031',
                'kode_prodi' => 'P01',
                'nama' => 'Admin',
                'jabatan' => 'Administrasi',
                'foto' => null,
                'email' => 'admin@gmail.com',
                'status' => '0',
                'password' => bcrypt('12345678'),
            ],
        ];
        foreach ($role as $key => $value){
            User::create($value);
        }
    }
}
