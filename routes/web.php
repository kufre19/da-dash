<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
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


Route::group(['middleware'=>"auth",'prefix'=>"dashboard"], function(){

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get("/account/create",[AdminController::class,"createUserAccount_page"]);
    Route::post("/account/create",[AdminController::class,"createUserAccount"]);
    Route::get("/account/list",[AdminController::class,"listAccounts"]);
    Route::get("/account/edit/{id}",[AdminController::class,"editAccount_page"]);
    Route::post("/account/edit/",[AdminController::class,"editUserAccount"]);
    Route::post("/account/delete/{id}",[AdminController::class,"deleAccount"]);

    Route::get("/service/create/",[AdminController::class,"showServicePage"]);
    Route::get("/service/list/",[AdminController::class,"listServices"]);
    Route::post("/service/create/",[AdminController::class,"createService"]);
    Route::get("/service/edit/{id}",[AdminController::class,"showServiceEditPage"]);
    Route::post("/service/delete/{id}",[AdminController::class,"deleteService"]);
    Route::post("/service/edit/",[AdminController::class,"editService"]);





});

require __DIR__.'/auth.php';
