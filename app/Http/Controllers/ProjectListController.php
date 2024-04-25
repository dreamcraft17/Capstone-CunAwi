<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectListController;

class ProjectListController extends Controller
{
    public function projectlist(){
        return view("pages.projectlist");
    }

     public function newproject(){
        return view("pages.newproject");
    }

    public function draft(){
        return view("pages.draft");
    }

    public function projectdetail(){
        return view("pages.projectdetail");
    }
}
