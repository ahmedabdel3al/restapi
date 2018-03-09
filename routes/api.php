<?php


use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * buyers route
 */
Route::resource('buyers','Buyer\BuyerController',['only'=>['index','show']]);
/**
 * category route
 */
Route::resource('categories','Category\CategoryController',['except'=>['create','edit']]);
/**
 * product route
 */
Route::resource('products','Product\ProductController',['only'=>['index','show']]);
/**
 * seler route
 */
Route::resource('selers','Seler\SelerController',['only'=>['index','show']]);
/**
 * users route
 */
Route::resource('users','User\UserController',['except'=>['create','edit']]);
/**
 * transcation route
 */
Route::resource('transactions','Transaction\TransactionController',['only'=>['index','show']]);
