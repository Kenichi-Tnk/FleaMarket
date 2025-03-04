<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ユーザー1',
            'email' => 'testuser@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'img_url' => 'img/icons/default_icon.svg',
            'postcode' => '1234567',
            'address' => '東京都渋谷区渋谷1-2-3-4',
            'building' => '渋谷ビル301',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory()->count(16)->create();
    }
}
