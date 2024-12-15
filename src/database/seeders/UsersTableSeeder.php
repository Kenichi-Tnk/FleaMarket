<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create({
            'name' => '管理者',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'img_url' => '/img/default_icon.svg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        });

        User::create({
            'name' => 'ユーザー名',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'img_url' => '/img/default_icon.svg',
            'remember_token' => Str::random,
            'created_at' => now(),
            'updated_at' => now(),
        });

        User::factory()->count(16)->create();
    }
}
