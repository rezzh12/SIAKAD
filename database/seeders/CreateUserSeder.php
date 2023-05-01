<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'id_status' => '55201200401',
                'name'      => 'IsUser',
                'username'  => 'IsUser',
                'email'     => 'user@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 4
            ],
            [
                'id_status' => '5520120042',
                'name'      => 'IsWalikelas',
                'username'  => 'IsWalikelas',
                'email'     => 'walikelas@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 3
            ],
            [
                'id_status' => '55201200403',
                'name'      => 'IsGuru',
                'username'  => 'IsGuru',
                'email'     => 'guru@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 2
            ],
            [
                'id_status' => '12345678910',
                'name'      => 'IsAdmin',
                'username'  => 'IsAdmin',
                'email'     => 'admin@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
