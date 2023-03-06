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
// accounts
    Route::get("/account/create",[AdminController::class,"createUserAccount_page"]);
    Route::post("/account/create",[AdminController::class,"createUserAccount"]);
    Route::get("/account/list",[AdminController::class,"listAccounts"]);
    Route::get("/account/edit/{id}",[AdminController::class,"editAccount_page"]);
    Route::post("/account/edit/",[AdminController::class,"editUserAccount"]);
    Route::post("/account/delete/{id}",[AdminController::class,"deleAccount"]);

    // services
    Route::get("/service/create/",[AdminController::class,"showServicePage"]);
    Route::get("/service/list/",[AdminController::class,"listServices"]);
    Route::post("/service/create/",[AdminController::class,"createService"]);
    Route::get("/service/edit/{id}",[AdminController::class,"showServiceEditPage"]);
    Route::post("/service/delete/{id}",[AdminController::class,"deleteService"]);
    Route::post("/service/edit/",[AdminController::class,"editService"]);

    // customers
    Route::get("/customers/create/",[AdminController::class,"add_new_customers_page"]);
    Route::post("/customers/create/",[AdminController::class,"add_new_customers"]);
    Route::get("/customers/list/",[AdminController::class,"list_customers_page"]);
    Route::get("/customers/history/{id}",[AdminController::class,"customer_history_page"]);
    Route::get("/customers/edit/{id}",[AdminController::class,"edit_customers_page"]);
    Route::post("/customers/delete/{id}",[AdminController::class,"delete_customer"]);
    Route::post("/customers/edit/",[AdminController::class,"edit_customers"]);


    // laundry
    Route::get("/laundry/create/",[AdminController::class,"laundry_create_page"]);
    Route::get("/laundry/basket/preview/{id?}",[AdminController::class,"laundry_preview_page"]);
    Route::get("/laundry/basket/clear",[AdminController::class,"laundry_basket_clear"]);
    Route::post("/laundry/basket/add/",[AdminController::class,"laundry_basket_add"]);
    Route::post("/laundry/basket/remove/{id}",[AdminController::class,"laundry_basket_remove"]);
    Route::get("/laundry/create/order",[AdminController::class,"laundry_create"]);
    Route::get("/laundry/basket/gallery/view/{id}",[AdminController::class,"laundry_gallery"]);
    Route::get("/laundry/basket/gallery/upload",[AdminController::class,"laundry_image_upload_page"]);
    Route::post("/laundry/basket/gallery/upload",[AdminController::class,"laundry_image_upload"]);











});

require __DIR__.'/auth.php';
