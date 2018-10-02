<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'All might',
            'email' => 'admin@site.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::where('name', 'superadmin')->first();
        if ($role) {
            $user->attachRole($role);
        }
    }
}
