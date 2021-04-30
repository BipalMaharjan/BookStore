<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShowController;
use App\Http\Controllers\CustomerContoller;
use App\Http\Controllers\DailyContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WeeklyContoller;
use App\Http\Controllers\MonthlyContoller;
use Illuminate\Support\Facades\DB;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/a', function () {
    return view('a');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::post('sellers/{seller}/activate', [SellerController::class,'activate'])->name('sellers.activate');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('sellers', SellerController::class);
    Route::resource('customer', CustomerContoller::class);
    // Route::resource('sales', SalesController::class);
});
Route::get('/logout',[LoginController::class,'logout']);

Route::get('/', [BookShowController::class,'index']);
Route::post('//{book}', [BookShowController::class,'store'])->name('buy');
// Route::get('showBook/{book}/show', [BookShowController::class,'store'])->name('showBook');
Route::get('detail/{book}', [BookShowController::class,'detail'])->name('detail');
// Route::get('/', [SalesController::class,'trending']);
Route::get('more-books',[BookShowController::class,'getMoreUser'])->name('more-books');
Route::get('search', [BookShowController::class,'search'])->name('search');


Route::get('sales', [SalesController::class,'index']);
Route::post('sales/{book}', [SalesController::class,'store'])->name('sales');
// Route::view('/history','history');
Route::get('/history', [SalesController::class,'history']);
Route::get('/trending', [SalesController::class,'trending']);

Route::view('/chart', 'chart');

Route::get('/daily',[DailyContoller::class, 'daily']);
Route::get('/weekly',[WeeklyContoller::class, 'weekly']);
Route::get('/monthly',[MonthlyContoller::class, 'monthly']);

