<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestController;

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

//勤怠操作画面の表示
Route::get('/index', [RestController::class, 'index'])->name('rest.index')->middleware('auth');

// ボタン押下
Route::post('/store', [RestController::class, 'store'])->name('rest.store');

//勤怠管理画面の表示
Route::get('/date', [RestController::class, 'date'])->name('rest.date')->middleware('auth');

// 打刻
Route::post('/create', [RestController::class, 'create'])->name('rest.create');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
