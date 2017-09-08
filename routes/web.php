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

});
