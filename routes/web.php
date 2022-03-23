<?php

use Illuminate\Support\Facades\Route;
use App\Models\RedesSociales;
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

Route::get('/', function() {
    
    $userOrders = RedesSociales::get(); 
    return view('welcome',['userOrders' => $userOrders]);
 });

 Route::post('guardar_encuesta', '\App\Http\Controllers\EncuestaController@store');

 Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);
  

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index']);
