<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_title' => $faker->text($maxNbChars = 20),
        'product_subtitle' => $faker->sentence,
        'product_short_description' => $faker->sentence(8),
        'product_description' => $faker->paragraph,
        'product_slug' => $faker->slug,
        'is_featured' => false,
        'purchase_price' => $faker->numberBetween(100, 900),
        'sale_price' => $faker->numberBetween(100, 900),
        'stock' => 100,
        'stock_alert' => 5,
        'product_image' => 'default.jpg',
        'category_id' => 1,
        'subcategory_id' => 1,
        'unit_id' => 1,
        'added_by' => 1
    ];
});
