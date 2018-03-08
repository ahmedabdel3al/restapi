<?php

use App\Category;
use App\Product;
use App\Seler;
use App\Transaction;
use App\User;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'), // secret
        'remember_token' => str_random('10'),
        'verified' =>  $verified=$faker->randomElement([true, false]),
        'verification_token' => ($verified == true)? null : user::generateVerificationCode(),
        'verified' => $faker->randomElement([User::admin, User::requar_user]),

    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),


    ];
});
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Product::AVILABLE, Product::UNAVILABLE]),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        'seler_id' => $faker->numberBetween(1, 4),


    ];
});
$factory->define(Transaction::class, function (Faker $faker) {
    $seler = Seler::has('products')->get()->random();
    $buyer = User::all()->only($faker->numberBetween(5,8))->random();
    return [
        'buyer_id' => $buyer->id,
        'product_id' => $seler->products->random()->id,
        'quantity' => $faker->numberBetween(1, 3),


    ];
});