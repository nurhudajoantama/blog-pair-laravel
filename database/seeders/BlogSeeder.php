<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Nurhuda',
                'username' => 'nurhuda',
                'email' => 'njoantama@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Raihan',
                'username' => 'raihanputra',
                'email' => 'raihanpd93@gmail.com',
                'password' => bcrypt('1234567'),
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
            ]
        ];

        User::factory()->count(1)->create();
        User::insert($users);
        Tag::factory()->count(3)->create();
        Blog::factory()->count(100)->create();
    }
}
