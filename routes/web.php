<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TagController;

Route::get('/api/tags', [TagController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/admin','AdminController@loginAdmin');

Route::post('/admin', 'AdminController@postLoginAdmin');

Route::group(['prefix' => 'filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/home', function () {
    return view('home');
});

//sử dụng prefix để gom nhóm các route của thằng cha admin
Route::prefix('admin')->group(function () {

    //sử dụng prefix để gom nhóm các route của thằng categories

//    Route::prefix('categories')->group(function () {
//        Route::get('/', [
//            'as' => 'categories.index',
//            'uses' => 'CategoryController@index'
//        ]);
//
//        Route::get('/create', [
//            'as' => 'categories.create',
//            'uses' => 'CategoryController@create'
//        ]);
//        Route::post('/store', [
//            'as' => 'categories.store',
//            'uses' => 'CategoryController@store'
//        ]);
//
//        Route::get('/edit/{id}', [
//            'as' => 'categories.edit',
//            'uses' => 'CategoryController@edit'
//        ]);
//
//        Route::post('/update/{id}', [
//            'as' => 'categories.update',
//            'uses' => 'CategoryController@update'
//        ]);
//
//        Route::get('/delete/{id}', [
//            'as' => 'categories.delete',
//            'uses' => 'CategoryController@delete'
//        ]);
//    });

//sử dụng prefix để gom nhóm các route của thằng menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index'
        ]);

        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create'
        ]);

        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete'
        ]);

    });


//sử dụng prefix để gom nhóm các route của thằng products, sản phẩm

//    Route::prefix('product')->group(function () {
//        Route::get('/', [
//            'as' => 'product.index',
//            'uses' => 'AdminProductController@index'
//        ]);
//
//        Route::get('/create', [
//            'as' => 'product.create',
//            'uses' => 'AdminProductController@create'
//        ]);
//
//        Route::post('/store', [
//            'as' => 'product.store',
//            'uses' => 'AdminProductController@store'
//        ]);
//        Route::get('/edit/{id}', [
//            'as' => 'product.edit',
//            'uses' => 'AdminProductController@edit'
//        ]);
//
//        Route::post('/update/{id}', [
//            'as' => 'product.update',
//            'uses' => 'AdminProductController@update'
//        ]);
//        Route::get('/delete/{id}', [
//            'as' => 'product.delete',
//            'uses' => 'AdminProductController@delete'
//        ]);
//    });

});

Route::group(['middleware' => ['web']], function () {
    Route::prefix('admin')->group(function () {

        Route::prefix('categories')->group(function () {
            Route::get('/', [
                'as' => 'categories.index',
                'uses' => 'CategoryController@index'
            ]);

            Route::get('/create', [
                'as' => 'categories.create',
                'uses' => 'CategoryController@create'
            ]);
            Route::post('/store', [
                'as' => 'categories.store',
                'uses' => 'CategoryController@store'
            ]);

            Route::get('/edit/{id}', [
                'as' => 'categories.edit',
                'uses' => 'CategoryController@edit'
            ]);

            Route::post('/update/{id}', [
                'as' => 'categories.update',
                'uses' => 'CategoryController@update'
            ]);

            Route::get('/delete/{id}', [
                'as' => 'categories.delete',
                'uses' => 'CategoryController@delete'
            ]);
        });


        Route::prefix('product')->group(function () {
            Route::get('/', [
                'as' => 'product.index',
                'uses' => 'AdminProductController@index'
            ]);

            Route::get('/create', [
                'as' => 'product.create',
                'uses' => 'AdminProductController@create'
            ]);

            Route::post('/store', [
                'as' => 'product.store',
                'uses' => 'AdminProductController@store'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'product.edit',
                'uses' => 'AdminProductController@edit'
            ]);

            Route::post('/update/{id}', [
                'as' => 'product.update',
                'uses' => 'AdminProductController@update'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'product.delete',
                'uses' => 'AdminProductController@delete'
            ]);
        });



//        Route::prefix('rooms')->group(function () {
//            Route::get('/', [
//                'as' => 'rooms.index',
//                'uses' => 'RoomsController@index'
//            ]);
//
//            Route::get('/create', [
//                'as' => 'rooms.create',
//                'uses' => 'RoomsController@create'
//            ]);
//            Route::post('/store', [
//                'as' => 'rooms.store',
//                'uses' => 'RoomsController@store'
//            ]);
//        });


        Route::prefix('slider')->group(function () {
            Route::get('/', [
                'as' => 'slider.index',
                'uses' => 'SliderAdminController@index'
            ]);
            Route::get('/create', [
                'as' => 'slider.create',
                'uses' => 'SliderAdminController@create'
            ]);
            Route::post('/store', [
                'as' => 'slider.store',
                'uses' => 'SliderAdminController@store'
            ]);


            Route::get('/edit/{id}', [
                'as' => 'slider.edit',
                'uses' => 'SliderAdminController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'slider.update',
                'uses' => 'SliderAdminController@update'
            ]);


            Route::get('/delete/{id}', [
                'as' => 'slider.delete',
                'uses' => 'SliderAdminController@delete'
            ]);
        });
    });

});





