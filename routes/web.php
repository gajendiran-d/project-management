<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    // return view('welcome');
    return Redirect::to('/login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/updateProfile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');

// Project Routes
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/update/{id}', [App\Http\Controllers\ProjectController::class, 'update'])->name('projects.update');
Route::get('/projects/delete/{id}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('projects.delete');

// Task Routes
Route::get('/tasks/list/{projectId}', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/update/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::get('/tasks/delete/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.delete');
Route::get('/tasks/assign', [App\Http\Controllers\TaskController::class, 'assign'])->name('tasks.assign');
Route::get('/tasks/status/{id}', [App\Http\Controllers\TaskController::class, 'status'])->name('tasks.status');

// Team Routes
Route::get('/teams/{projectId}', [App\Http\Controllers\TeamMemberController::class, 'index'])->name('teams.index');
Route::post('/teams/assign', [App\Http\Controllers\TeamMemberController::class, 'assign'])->name('teams.assign');
