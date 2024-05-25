<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectListController;
use App\Http\Controllers\TaskManagerController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DssController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\DropController;
use App\Http\Controllers;

// Routes accessible to all users
Route::get('/', function () {
    return view('authorization.login');
});

// Authentication routes
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');


// Routes that require authentication
Route::middleware('auth')->group(function () {
    // Authorization
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Main menu
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/projectlist', [ProjectListController::class, 'projectlist'])->name('projectlist');
    Route::get('/taskmanager', [TaskManagerController::class, 'index'])->name('taskmanager');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/dss', [DssController::class, 'index'])->name('dss');
    Route::get('/draft', [ProjectListController::class, 'draft'])->name('draft');
    Route::get('display-drop', [DropController::class, 'displaydrop'])->name('display.drop');
    Route::get('display-draft', [DraftController::class, 'displaydraft'])->name('display.draft');

    // Functions
    Route::post('/dss', [DssController::class, 'evaluateProductionDecision'])->name('production.decision');
    Route::get('display-project', [ProjectListController::class, 'displayProject'])->name('display.project');
    Route::get('/dropproject', [DropController::class, 'drop'])->name('drop');
    Route::get('/editproject/{id}', [ProjectListController::class, 'editproject'])->name('editproject');
    Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('calendar.events');
    Route::get('/newproject', [ProjectListController::class, 'newproject'])->name('newproject');
    Route::get('/projectdetail/{id}', [ProjectListController::class, 'projectdetail'])->name('projectdetail');
    Route::get('/profile/edit', [UserController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/profile/update', [UserController::class, 'update_profile'])->name('update_profile');
    Route::get('/projectdetail/{project}', [ProjectListController::class, 'showProjectDetail'])->name('projectdetail');
    Route::get('/projects/{date}', 'CalendarController@getProjectsByDate');
    Route::post('/projects/{id}', [ProjectListController::class, 'update'])->name('update.project');
    Route::post('/project/drop/{id}', [ProjectListController::class, 'dropProject'])->name('project.drop');
    Route::post('/projectreinstate/{id}', [ProjectListController::class, 'reinstateProject'])->name('project.reinstate');
    Route::delete('/projects/{id}', [ProjectListController::class, 'delete']);
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('delete_user');
    Route::post('/new-project', [ProjectListController::class, 'storeNewProject'])->name('storeNewProject');
    Route::post('/new-project-submit', [ProjectListController::class, 'submitNewProject'])->name('submitNewProject');
    Route::get('/redirect-to-projectlist/{projectId}', [TaskManagerController::class, 'redirectToProjectList'])->name('redirect.projectlist');



    // Route::get('/editproject', [ProjectListController::class, 'editproject'])->name('editproject');

    // Route::post('/updateproject/{id}', [ProjectListController::class, 'updateProject'])->name('updateProject');

    // Route::get('/projectdetail/{projectId}', [ProjectListController::class, 'showDataDetail'])->name('projectdetail');

    // Route::get('/editproject/{id}', 'ProjectListController@editProject')->name('editproject');
    // Route::post('/updateproject/{id}', 'ProjectListController@updateProject')->name('updateproject');

    // Route::post('updateProject/{id}', [ProjectListController::class, 'updateProject'])->name('updateProject');
    // Route::put('/drop/{id}', 'ProjectListController@dropProject')->name('drop.project');
    // Route::post('/project/delete/{id}', 'ProjectListController@delete')->name('project.delete');










});

