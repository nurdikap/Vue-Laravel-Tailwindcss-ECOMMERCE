<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {

    Route::get('test', function () {
        return view('test');
    });
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('subcategories', 'SubcategoryController');
    Route::resource('attributes', 'AttributeController');
    Route::resource('variations', 'VariationController');
    Route::get('getVariations', 'VariationController@getVariations');
    Route::get('getVariation/{variation}', 'VariationController@getVariation');

    Route::get('categories/{category}/getSubcategories', 'CategoryController@getSubcategories');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/categorias', function () {
    return view('index');
});

Route::get('/{category}/{subcategory}', function () {
    return view('index');
});
Route::get('product/{productId}/{slug}', function () {
    return view('index');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
