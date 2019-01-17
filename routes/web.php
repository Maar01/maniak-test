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

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', 'BookController');
Route::post('book/status', 'BookController@changeStatus')->name('books.status');

Route::get('user/{name?}', function ($name) {

    return \DB::table('users')->select('name', 'id')
        ->where('name', 'like', "%$name%")
        ->get();
})->name('users.coincidence');