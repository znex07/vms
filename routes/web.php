<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

Route::resource('persons', App\Http\Controllers\PersonController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('search', [App\Http\Controllers\PersonController::class, 'search'])->name('search');
Route::get('searchbyname', [App\Http\Controllers\PersonController::class, 'searchby'])->name('search');
Route::get('dashboard', [App\Http\Controllers\PersonController::class, 'index'])->name('dashboard');
Route::post('trace', [App\Http\Controllers\PersonController::class, 'trace'])->name('trace');
Route::post('pdflogs',[App\Http\Controllers\PersonController::class, 'pdflogs'])->name('pdflogs');
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'QR Trace',
        'body' => 'This is your QR code. Keep it private. Do not share it with anybody. Do not post it to any social media.'
    ];
   
    \Mail::to('istraor999@gmail.com')->send(new \App\Mail\Email($details));
   
    dd("Email is Sent.");
});
