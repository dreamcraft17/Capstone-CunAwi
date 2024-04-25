<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectListController;
use App\Http\Controllers\TaskManagerController;

class TaskManagerController extends Controller
{
    public function taskmanager(){
        return view("pages.taskmanager");
    }
}
