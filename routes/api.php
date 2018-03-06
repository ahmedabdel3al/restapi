<?php

use Illuminate\Http\Request;
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
Route::resource('categories','Category\CategoryController',['except'=>['index','edit']]);
/**
 * product route
 */
Route::resource('products','Product\ProductController',['only'=>['index','edit']]);
/**
 * seler route
 */
Route::resource('selers','Seler\SelerController',['only'=>['index','edit']]);
/**
 * users route
 */
Route::resource('users','User\SelerController',['except'=>['index','edit']]);
/**
 * transcation route
 */
Route::resource('transcations','Transcation\TranscationController',['only'=>['index','edit']]);
