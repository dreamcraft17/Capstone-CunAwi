<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ProjectListController;
use App\Http\Controllers\TaskManagerController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DssController;


Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/projectlist', [ProjectListController::class, 'projectlist'])->name('projectlist');
Route::get('/newproject', [ProjectListController::class, 'newproject'])->name('newproject');
Route::get('/draft', [ProjectListController::class, 'draft'])->name('draft');
Route::get('/projectdetail', [ProjectListController::class, 'projectdetail'])->name('projectdetail');
Route::get('/taskmanager', [TaskManagerController::class, 'taskmanager'])->name('taskmanager');
Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');
Route::get('/dss', [DssController::class, 'dss'])->name('dss');

Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::get('/register', [AuthorizationController::class, 'register'])->name('register');
Route::get('/profile', [AuthorizationController::class, 'profile'])->name('profile');
