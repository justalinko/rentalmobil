<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\Armada::factory(50)->create();

        \App\Models\Websetting::factory(1)->create();

        \App\Models\Order::factory(100)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'            
        ]);
        $payments = [
            [
                'name' => 'Bank Central Asia',
                'icon' => '/assets/images/bca.png',
                'description' => 'BCA 122343948 a/n PT. Karya Mitra Mandiri',
                'primary' => 1,
                'status' => 'active'
            ],
            [
                'name' => 'Bank Mandiri',
                'icon' => '/assets/images/mandiri.png',
                'description' => 'Mandiri 122343948 a/n PT. Karya Mitra Mandiri',
                'primary' => 0,
            ],
            [
                'name' => 'Cash On Pickup',
                'icon' => '/assets/images/cash.png',
                'description' => 'Pay with cash when you pickup your order',
            ]
            ];

        foreach ($payments as $payment) {
            \App\Models\PaymentMethod::create($payment);
        }
        
    }
}
