<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\ScheduleController;

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

Route::get('lp/contact', function () {
    return view('lp.contact');
});

Route::get('lp/thanks', function () {
    return view('lp.thanks');
});

Route::resource('goal', GoalController::class)->middleware('auth');

Route::resource('task', TaskController::class)->middleware('auth');

Route::resource('task_category', TaskCategoryController::class)->middleware('auth');

Route::resource('schedule', ScheduleController::class)->middleware('auth');

Route::get('schedulesammary', [ScheduleController::class, 'sammary'])->middleware('auth');

Route::get('commonschedule', [ScheduleController::class, 'common'])->middleware('auth');

Route::get('taskcategory', [TaskController::class, 'category'])->middleware('auth');

Route::get('taskpriority', [TaskController::class, 'priority'])->middleware('auth');

Route::get('taskseverity', [TaskController::class, 'severity'])->middleware('auth');

Route::get('tasktotallpriority', [TaskController::class, 'totallpriority'])->middleware('auth');

Route::get('taskcomplete', [TaskController::class, 'complete'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [UserController::class, 'index'])->name('dashboard');
