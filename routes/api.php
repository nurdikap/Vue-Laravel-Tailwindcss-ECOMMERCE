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

Route::apiResource('products','Api\ProductController');
Route::apiResource('variations','Api\VariationController');
Route::apiResource('attributes','Api\AttributeController');
Route::apiResource('categories','Api\CategoryController');
Route::get('categories/{category}/getSubcategories','Api\CategoryController@getSubcategories');

Route::apiResource('subcategories','Api\SubcategoryController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
