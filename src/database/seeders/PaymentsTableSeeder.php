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
            'method' => 'コンビニ払い',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
