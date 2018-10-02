<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        // $this->call(PaymentMethodsSeeder::class);
        // $this->call(BannersTableSeeder::class);
        // $this->call(SettingTableSeeder::class);
    }
}
