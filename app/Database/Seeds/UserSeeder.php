<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = new \App\Models\UserModel;

        $date = [
            [
                'name' => 'Shane',
                'email' => 'shane@gmail.com',
                'gender' => 'male',
                'profile_description' => 'This is my bio who am i',
                'profile_image' => '1653386810_74a048dcba99ed366f5a.jpg'
            ],
            [
                'name' => 'Testing',
                'email' => 'Tesasdf@mail.com',
                'gender' => 'female',
                'profile_description' => 'Testing Bio',
                'profile_image' => '1653399218_b0096cefe4c7ac4eb192.jpg'
            ],
            [
                'name' => 'Alice',
                'email' => 'alice@mail.com',
                'gender' => 'female',
                'profile_description' => 'This is the bio of Alice',
                'profile_image' => '1653400475_670617fd8b25c86dd78a.jpg'
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@mail.com',
                'profile_description' => 'This is the bio of Bob',
                'gender' => 'male',
                'profile_image' => '1653402558_6e588da2906a5a274912.png'
            ]
        ];

        $model->protect(false)->insertBatch($date);
    }
}
