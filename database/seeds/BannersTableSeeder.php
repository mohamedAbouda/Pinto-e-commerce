<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'key' => 'home_side_img1',
                'note' => 'Prefered size is : 290 x 212',
                'title' => 'home page img 1 next to slider',
                'image' => '',
                'url' => ''
            ],
            [
                'key' => 'home_side_img2',
                'note' => 'Prefered size is : 290 x 212',
                'title' => 'home page img 2 next to slider',
                'image' => '',
                'url' => ''
            ],
            [
                'key' => 'home_slider_footer_img1',
                'note' => 'Prefered size is : 364 x 104',
                'title' => 'home page img 1 under the slider',
                'image' => '',
                'url' => ''
            ],
            [
                'key' => 'home_slider_footer_img2',
                'note' => 'Prefered size is : 364 x 104',
                'title' => 'home page img 2 under the slider',
                'image' => '',
                'url' => ''
            ],
            [
                'key' => 'home_slider_footer_img3',
                'note' => 'Prefered size is : 364 x 104',
                'title' => 'home page img 3 under the slider',
                'image' => '',
                'url' => ''
            ],
            [
                'key' => 'home_best_sellers_img',
                'note' => 'Prefered size is : 241 x 165',
                'title' => 'home page img 1 in best sellers section',
                'image' => '',
                'url' => ''
            ]
        ]);
    }
}
