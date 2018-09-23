<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;
//
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });

// factory(\App\Models\Product::class ,30)->create();
$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    $sub_categories_id = App\Models\SubCategory::pluck('id')->toArray();
    $brands_id = App\Models\Brand::pluck('id')->toArray();
    // $merchants_id = App\Models\Merchant::pluck('id')->toArray();
    // $key_word_id = App\Models\KeyWord::pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'description' => $faker->sentences(10 ,true),
        'short_description' => $faker->sentences(10 ,true),
        'technical_specs' => $faker->sentences(10 ,true),
        'cover_image' => $faker->imageUrl(640,480),
        'price' => $faker->randomNumber(2),
        'sub_category_id' => $faker->randomElement($sub_categories_id),
        'brand_id' => $brands_id ? $faker->randomElement($brands_id) : NULL,
        // 'merchant_id' => $faker->randomElement($merchants_id),
        'featured' => 0,
        'sku' => $faker->unique()->word(),
        'views' => 0,
        // 'key_word_id' => $key_word_id ? $faker->randomElement($key_word_id) : NULL,
        // 'approved' => 1,
        // 'match_keys' => 'key,words',
    ];
});
