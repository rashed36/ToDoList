<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoListController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/add/new/task', [ToDoListController::class, 'store'])->name('tasks.store');
Route::get('/edit/task/{id}', [ToDoListController::class, 'edit'])->name('tasks.edit');
Route::post('/task/update/{id}', [ToDoListController::class, 'update'])->name('tasks.update');
Route::get('/task/delete/{id}', [ToDoListController::class, 'destroy'])->name('tasks.destroy');
Route::get('/complete/task/{id}', [ToDoListController::class, 'complete'])->name('complete.tasks');
Route::get('/end/task/show', [ToDoListController::class, 'show'])->name('end.tasks.show');

