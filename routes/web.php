<?php
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products/{category?}', 'ProductsController@index')->name('products.index');

Route::get('api/products/{category?}', 'Api\ProductsController@index')->name('api.products.index');

/**
 * Manage Araa
 */

Route::group([ 'prefix' => '/manage', 'middleware' => ['onlyAdmins'] ], function () {

    Route::get('/', 'Manage\HomeController@index')->name('manage.home');

    /**
     * Manage Categories
     */

    Route::get('/categories', 'Manage\CategoriesController@view')->name('manage.categories.view');

    Route::get('/api/categories', 'Manage\CategoriesController@index')->name('manage.categories.index');
    Route::post('/api/categories', 'Manage\CategoriesController@store')->name('manage.categories.store');
    Route::get('/api/categories/{category}', 'Manage\CategoriesController@show')->name('manage.categories.show');
    Route::patch('/api/categories/{category}', 'Manage\CategoriesController@update')->name('manage.categories.update');
    Route::delete('/api/categories/{category}', 'Manage\CategoriesController@destroy')->name('manage.categories.destroy');

    /**
     * Manage Products
     */
    Route::get('/products', 'Manage\ProductsController@view')->name('manage.products.view');

    Route::get('/api/products', 'Manage\ProductsController@index')->name('manage.products.index');

    Route::post('/api/vendors/{vendorId}/product', 'Manage\VendorsProductsController@store')->name('manage.vendors.products.store');

});
