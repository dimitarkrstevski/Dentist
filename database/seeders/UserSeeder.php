<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
           [ 'id'=>1,
               'name' => 'Doctor',
               'surname' => 'Admin',
               'phone_number' => '070777777',
               'email' => 'doctor@dentist.com',
               'password' => Hash::make('12345678'),
               'EMBG' => '1234567890123',
               'street' => 'UL. Ilindenska',
               'city' => 'Tetovo',
               'date_of_birth' => '1990-01-01',
               'role_id' => 1],
                ['id'=>2,
                    'name' => 'Doctor',
                'surname' => 'Doctor',
                'phone_number' => '070777777',
                'email' => 'doctor1@dentist.com',
                'password' => Hash::make('12345678'),
                'EMBG' => '0987654321123',
                'street' => 'UL. Ilindenska',
                'city' => 'Tetovo',
                'date_of_birth' => '1990-01-01',
                'role_id' => 2],
            [   'id' => 3,
                'name' => 'Patient',
                'surname' => 'Test',
                'phone_number' => '070777777',
                'email' => 'patient@dentist.com',
                'password' => Hash::make('12345678'),
                'EMBG' => '1029384756109',
                'street' => 'UL. Ilindenska',
                'city' => 'Tetovo',
                'date_of_birth' => '1990-01-01',
                'role_id' => 4
            ]
        ]);

    }
}
