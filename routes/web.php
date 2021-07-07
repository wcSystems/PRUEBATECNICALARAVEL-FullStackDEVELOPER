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

// VIEW AND CRUD - USERS
Route::resource('users', 'UsersController')->names([
    'index' => 'users',
    'create' => 'users.create',
    'update' => 'users.update',
    'destroy' => 'users.destroy'
]);

// VIEW AND CRUD - PALETTE_COLORS
Route::resource('palette_colors', 'PaletteColorsController')->names([
    'index' => 'palette_colors',
    'create' => 'palette_colors.create',
    'update' => 'palette_colors.update',
    'destroy' => 'palette_colors.destroy'
]);

// PERFIL_COLOR_CHANGE
Route::post('/palette_colors/perfil_colors_change', 'PaletteColorsController@perfil_colors_change')->name('palette_colors.perfil_colors_change');



Route::get('{any}', function() {
    return redirect('login');
 })->where('any', '.*');
