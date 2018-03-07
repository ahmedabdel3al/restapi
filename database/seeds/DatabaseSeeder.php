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

        $usersQuantity = 8;
        $catrgriesQuantity = 4;
        $productsQuantity = 10;
        $transationsQuantity = 10;

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $catrgriesQuantity)->create();
        factory(Product::class, $productsQuantity)->create()->each(function ($products) {
            $categories = Category::all()->random(mt_rand(1, 4))->pluck('id');
            $products->categories()->attach($categories);
        });
        factory(Transaction::class, $transationsQuantity)->create();
    }
}
