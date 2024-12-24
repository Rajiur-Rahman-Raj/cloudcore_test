<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'login');

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/add/task', [App\Http\Controllers\HomeController::class, 'addTask'])->name('add.task');
    Route::post('/task/store', [App\Http\Controllers\HomeController::class, 'taskStore'])->name('task.store');
    Route::get('/task/list', [App\Http\Controllers\HomeController::class, 'taskList'])->name('task.list');
    Route::delete('/task/delete/{id}', [App\Http\Controllers\HomeController::class, 'taskDelete'])->name('task.delete');
    Route::get('/task/edit/{id}', [App\Http\Controllers\HomeController::class, 'taskEdit'])->name('task.edit');
    Route::post('/task/update/{id}', [App\Http\Controllers\HomeController::class, 'taskUpdate'])->name('task.update');
});
