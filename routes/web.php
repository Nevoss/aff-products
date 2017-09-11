<?php
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products/{category?}', 'ProductsController@index')->name('products.index');

Route::get('api/products/{category?}', 'Api\ProductsController@index')->name('api.products.index');

/**
 * Manage Araa
 */

Route::group([ 'prefix' => '/manage', 'middleware' => ['onlyAdmins'] ], function () {

    Route::get('/', 'Manage\ManageHomeController@index')->name('manage.home');

    Route::get('/categories', 'Manage\ManageCategoriesController@view')->name('manage.categories.view');

    Route::get('/api/categories', 'Manage\ManageCategoriesController@index')->name('manage.api.categories.index');
    Route::post('/api/categories', 'Manage\ManageCategoriesController@store')->name('manage.api.categories.store');
    Route::patch('/api/categories/{category}', 'Manage\ManageCategoriesController@update')->name('manage.api.categories.update');

});
