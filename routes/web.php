<?php

use App\Models\formation;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/formations','App\Http\Controllers\formController@index')->name('formation');


Route::group(['auth:sanctum', 'verified'],function() {
    Route::get('/formations/{id}','App\Http\Controllers\formController@show')->name('formation.show');
    Route::post('/toggleProgress','App\Http\Controllers\formController@toggleProgress')->name('formation.toggle');

   

    Route::get('/dashboard ', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::post('/courses','App\Http\Controllers\formController@store');
    Route::get('/courses/edit/{id}','App\Http\Controllers\formController@edit');
    Route::patch('/courses/{id}','App\Http\Controllers\formController@update');
});
