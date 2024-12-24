<?php

use App\Http\Controllers\HomeController;
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
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/add/task', [HomeController::class, 'addTask'])->name('add.task');
    Route::post('/task/store', [HomeController::class, 'taskStore'])->name('task.store');
    Route::get('/task/list', [HomeController::class, 'taskList'])->name('task.list');
    Route::get('/task/edit/{id}', [HomeController::class, 'taskEdit'])->name('task.edit');
    Route::delete('/task/delete/{id}', [HomeController::class, 'taskDelete'])->name('task.delete');
    Route::post('/task/update/{id}', [HomeController::class, 'taskUpdate'])->name('task.update');
});
