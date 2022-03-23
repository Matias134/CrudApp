<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthorController::class)->group(function () {
    Route::get('/autores', 'index')->name('author.index');
    Route::get('/autor/crear', 'create')->name('author.create');
    Route::get('/autor/editar/{author}', 'edit')->name('author.edit');
    Route::get('/autor/{author}', 'show')->name('author.show');
    Route::post('/autor/crear', 'store')->name('author.store');
    Route::put('/autor/editar/{author}', 'update')->name('author.update');
    Route::delete('/autor/eliminar/{author}', 'destroy')->name('author.destroy');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/', 'index')->name('book.index');
    Route::get('/libro/crear', 'create')->name('book.create');
    Route::get('libro/editar/{book}', 'edit')->name('book.edit');
    Route::get('libro/{book}', 'show')->name('book.show');
    Route::post('libro/crear', 'store')->name('book.store');
    Route::put('libro/editar/{book}', 'update')->name('book.update');
    Route::put('libro/editar/imagen/{book}', 'update_image')->name('book.update_image');
    Route::delete('libro/eliminar/{book}', 'destroy')->name('book.destroy');

});