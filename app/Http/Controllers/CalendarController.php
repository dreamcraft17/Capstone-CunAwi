<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectListController;
use App\Http\Controllers\TaskManagerController;
use App\Models\Data;


class CalendarController extends Controller
{
    public function index(){
        $projects = Data::all();
        
        $events = [];
        foreach ($projects as $project) {
            $events[] = [
                'title' => $project->toyName . ' - ' . $project->status,
                'start' => $project->start_date,
            ];
        }
        
        return view("pages.calendar2", compact('events'));
    }
}

