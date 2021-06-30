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


Auth::routes();

//rutas de users
Route::get('/users/service', 'UsersController@service')->name('users.service');
Route::resource('users', 'UsersController')->names([
    'index' => 'users',
    'create' => 'users.create',
    'update' => 'users.update',
    'destroy' => 'users.destroy'
]);

/* aca redirigimos las rutas inexistentes */
Route::get('{any}', function() {
    return redirect('login');
 })->where('any', '.*');
