<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
 
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
 

 

Route::get("/",[HomeController::class,"index"]);


Route::get("/users",[AdminController::class,"user"]);

Route::get("/deletemenu/{food}",[AdminController::class,"deletemenu"]);

Route::get("/foodmenu",[AdminController::class,"foodmenu"]);

Route::post("/uploadfood",[AdminController::class,"upload"]);


Route::delete("/deleteuser/{user}", [AdminController::class,"deleteuser"]);


Route::get("/updateview/{id}",[AdminController::class,"updateview"]);


Route::post("/update/{id}",[AdminController::class,"update"]);






Route::post("/reservation",[AdminController::class,"reservation"]);


Route::get("/viewreservation",[AdminController::class,"viewreservation"])->middleware('auth');


Route::get("/viewchef",[AdminController::class,"viewchef"]);


Route::post("/uploadchef",[AdminController::class,"uploadchef"]);



Route::get("/updatechef/{food_chef}",[AdminController::class,"updatechef"]);


Route::post("/updatefoodchef/{food_chef}",[AdminController::class,"updatefoodchef"]);


Route::get("/deletechef/{food_chef}",[AdminController::class,"deletechef"]);



Route::post("/addcart/{id}",[HomeController::class,"addcart"])->middleware(['auth', 'web']);

Route::get("/showcart/{id}",[HomeController::class,"showcart"])->middleware('auth');



Route::get("/remove/{id}",[HomeController::class,"remove"]);



Route::post("/orderconfirm",[HomeController::class,"orderconfirm"]);



Route::get("/orders",[AdminController::class,"orders"]);



Route::get("/search",[AdminController::class,"search"]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
