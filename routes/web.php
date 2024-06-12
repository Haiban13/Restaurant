<?php

use App\Http\Controllers\GoogleLogin;
use App\Http\Controllers\midtrans;
use App\Http\Controllers\orderController;
use App\Http\Controllers\OrderDetailsController;

use App\Http\Middleware\CheckForCookie;
use App\Livewire\Cart;
use App\Livewire\Home;
use App\Livewire\menu as menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/checkout',[midtrans::class,"checkout"])->name('checkout');
Route::get('/menu',menu::class)->name('livewire.menu');
Route::get('/google/redirect',[GoogleLogin::class,'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback',[GoogleLogin::class,'handleGoogleCallback'])->name('google.callback');
// Route::post('/orderDetails',[OrderDetailsController::class,'store'])->name('orderDetails.store');
// Route::post('/addQuantity/{id}',[OrderDetailsController::class,'addQuantity'])->name('orderDetails.add');
// Route::post('/reduceQuantity/{id}',[OrderDetailsController::class,'reduceQuantity'])->name('orderDetails.reduce');
Route::get('/session',function(){
    dd(  session('cart')['user_id']);
});



Route::get('/', Home::class);
