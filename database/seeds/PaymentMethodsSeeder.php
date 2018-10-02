<?php

use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'name' => 'VISA',
                'icon' => '//',
                'availability' => 0,
            ],
            [
                'name' => 'PayPal',
                'icon' => '//',
                'availability' => 0,
            ],
            [
                'name' => 'Cash on delivery',
                'icon' => '//',
                'availability' => 0,
            ],
        ]);
    }
}
