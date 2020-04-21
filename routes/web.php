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

Route::get("/", "IndexController@index");
Route::get("howto", "IndexController@howto")->name("howto");

Auth::routes();

Route::get("statistics", "StatisticsController@statistics")->name("statistics");

/*
Route::get("statistics", function() {
        return view("statistics");
    });
*/

Route::resource("scores", "ScoresController");