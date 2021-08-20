<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', ['as' => 'upload', 'uses' => 'App\Http\Controllers\S3Controller@upload']);
Route::post('/upload', ['as' => 'upload', 'uses' => 'App\Http\Controllers\S3Controller@store']);
Route::get('/download/{image}', ['as' => 'download', 'uses' => 'App\Http\Controllers\S3Controller@show']);