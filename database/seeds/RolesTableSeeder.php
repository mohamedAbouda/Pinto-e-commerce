<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'superAdmin',
                'display_name' => 'Super Admin',
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'display_name' => 'Admin',
            ],
        ]);
        // DB::table('role_user')->insert([
        //     'user_id' => 1,
        //     'role_id' => 1,
        // ]);
    }
}
