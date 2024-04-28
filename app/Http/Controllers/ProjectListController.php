<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\Data;
// use App\Http\Controllers\ProjectListController;

class ProjectListController extends Controller
{
    public function projectlist(){
        $projects = Data::all(); 
    
        return view("pages.projectlist", compact('projects')); 
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

    public function delete($project)
    {
        $project = Data::findOrFail($project);
        $project->delete();
    
        return redirect()->route('projectlist')->with('success', 'Project deleted successfully');
    }
    
    

}
