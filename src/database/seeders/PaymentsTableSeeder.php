<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'method' => 'クレジットカード',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Payment::create([
            'method' => '銀行振込',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Payment::create([
            'method' => '後払い決済',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Payment::create([
            'method' => '代金引換',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Payment::create([
            'method' => 'コンビニ払い',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
