<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class TaskManagerController extends Controller
{
    public function index()
    {
        
        $projects = Data::where('status', 'on going')->get();

        return view('pages.taskmanager', compact('projects'));
    }

    public function selectProject($projectId)
    {
        $projectListController = new ProjectListController();
        return $projectListController->redirectToProjectList($projectId);
    }
}
