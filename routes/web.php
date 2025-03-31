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

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

// ホーム画面(初期)
Route::get('/list', [App\Http\Controllers\ProductController::class, 'list'])->name('list')->middleware('auth');

// ホーム画面(検索)
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');

// 新規登録画面
Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create')->middleware('auth');

// 新規登録処理
Route::post('/create', [App\Http\Controllers\ProductController::class, 'add'])->name('add');

// 詳細画面
Route::get('/info/{id}', [App\Http\Controllers\ProductController::class, 'info'])->name('info');

// 編集画面
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');

// 編集処理
Route::post('/edit', [App\Http\Controllers\ProductController::class, 'update'])->name('update');

Route::get('/delete/{id}',[App\Http\Controllers\ProductController::class, 'delete'])->name('delete');