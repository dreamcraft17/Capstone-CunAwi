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
        return view("pages.calendar2");
    }

    public function getProjectsByDate($date) {
        // Ambil nama proyek berdasarkan tanggal
        $projects = Data::whereDate('start_date', $date)->pluck('toyName')->toArray();
    
        return response()->json($projects);
    }
}
