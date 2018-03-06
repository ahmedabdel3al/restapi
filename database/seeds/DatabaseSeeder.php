<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $usersQuantity = 200;
        $catrgriesQuantity = 30;
        $productsQuantity = 1000;
        $transationsQuantity = 1000;

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $catrgriesQuantity)->create();
        factory(Product::class, $productsQuantity)->create()->each(function ($products) {
            $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
            $products->categories()->attach($categories);
        });
        factory(Transaction::class, $transationsQuantity)->create();
    }
}
