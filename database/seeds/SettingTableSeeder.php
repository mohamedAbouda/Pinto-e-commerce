<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'site_name' => '',
            'logo' => '',
            'description' => '',
            'facebook_pixel_base_code' => '',
            'facebook_pixel_event_code' => '',
            'google_analytics' => '',
            'contact_us_phone' => '',
            'contact_us_address' => '',
            'contact_us_description' => '',
            'contact_us_coordinates' => '',
            'fb_link' => '',
            'tw_link' => '',
            'pin_link' => '',
            'tu_link' => '',
            'gp_link' => '',
            'hotline' => '',
            'web_menu' => '[{"deleted":0,"new":1,"slug":"web.index","name":"Home","id":1496063209571},{"deleted":0,"new":1,"slug":"#","name":"Featured","id":1496063218618,"children":[{"deleted":0,"new":1,"slug":"web.products.index","name":"All products","id":1496063260566},{"deleted":0,"new":1,"slug":"$categories","name":"Categories","id":1496063246762}]},{"deleted":0,"new":1,"slug":"web.blog.index","name":"Blog","id":1496063222609},{"deleted":0,"new":1,"slug":"web.contactUs","name":"Contact us","id":1496063232714},{"deleted":0,"new":1,"slug":"web.aboutUs","name":"About","id":1496063238551}]',
            'web_menu_default' => '[{"deleted":0,"new":1,"slug":"web.index","name":"Home","id":1496063209571},{"deleted":0,"new":1,"slug":"#","name":"Featured","id":1496063218618,"children":[{"deleted":0,"new":1,"slug":"web.products.index","name":"All products","id":1496063260566},{"deleted":0,"new":1,"slug":"$categories","name":"Categories","id":1496063246762}]},{"deleted":0,"new":1,"slug":"web.blog.index","name":"Blog","id":1496063222609},{"deleted":0,"new":1,"slug":"web.contactUs","name":"Contact us","id":1496063232714},{"deleted":0,"new":1,"slug":"web.aboutUs","name":"About","id":1496063238551}]',
        ]);
    }
}
