<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * フロントサイド
 */
Route::namespace('Front')->name('front.')->group(function () {
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]);

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('products', 'ProductsController', ['only' => ['index', 'show']]);
    Route::resource('/products/{product}/product_reviews', 'ProductReviewsController', ['only' => ['create', 'edit', 'store', 'update']]);
    Route::post('/wish_product', 'ProductsController@wish_product');
    Route::resource('users', 'FrontUsersController', ['only' => ['edit',  'update']]);
    Route::post('/charge/{product}','PaymentController@charge')->name('charge');
});

/**
 * 管理サイド
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::middleware('auth:admin')->group(function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('product_categories', 'ProductCategoriesController');
        Route::resource('users', 'UsersController');
        Route::resource('products', 'ProductsController');
        Route::resource('admin_users', 'AdminUsersController');
    });
});

/**
 * リダイレクト
 */
Route::redirect('/', '/home');
Route::redirect('/admin', '/admin/home');
