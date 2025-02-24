<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TasksController;
use App\Livewire\EditTask;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');

Route::get('/user/login', function () {
    return view('/user/login');
})->name('user.login');

Route::get('/user/register', function () {
    return view('/user/register');
})->name('user.register');

// Calendar routes
Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::post('books', [BookController::class, 'store'])->name('books.store');

Route::get('/export-db', function() {
    return "Exporting";
});
Route::get('/user/addtask', function () {
    return view('/user/addtask');
})->name('user.addtask');

Route::get('/user/add-task', [UsersController::class, 'addTask'])->name('user.addTask');
Route::post('user/save', [UsersController::class, 'save'])->name('user.save');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




Route::post('user/check', [UsersController::class, 'check'])->name('user.check');

Route::get('user/tasks', [UsersController::class, 'tasks'])->name('user.tasks');

Route::post('user/logout', [UsersController::class, 'logout'])->name('user.logout');

Route::get('/user/addtask', [UsersController::class, 'addtasks'])->name('user.addtask');







Route::get('/tasks/{id}', [TasksController::class, 'show'])->name('tasks.show');
Route::get('/tasks/edit/{id}', [TasksController::class, 'edit'])->name('tasks.edit');
Route::delete('tasks/{taskId}', [TasksController::class, 'destroy'])->name('tasks.destroy');
Route::put('tasks/{taskId}', [TasksController::class, 'update'])->name('tasks.update');


