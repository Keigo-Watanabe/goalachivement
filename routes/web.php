<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

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
    return view('lp.top');
});

Route::get('lp/goal', function () {
    return view('lp.goal');
});

Route::get('lp/task', function () {
    return view('lp.task');
});

Route::get('lp/schedule', function () {
    return view('lp.schedule');
});

Route::get('lp/contact', function () {
    return view('lp.contact');
});

Route::resource('goal', GoalController::class)->middleware('auth');

Route::resource('task', TaskController::class)->middleware('auth');

Route::get('taskcategory', [TaskController::class, 'category'])->middleware('auth');

Route::get('taskpriority', [TaskController::class, 'priority'])->middleware('auth');

Route::get('taskseverity', [TaskController::class, 'severity'])->middleware('auth');

Route::get('tasktotallpriority', [TaskController::class, 'totallpriority'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [UserController::class, 'index'])->name('dashboard');
