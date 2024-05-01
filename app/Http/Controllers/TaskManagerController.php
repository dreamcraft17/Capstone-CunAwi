<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class TaskManagerController extends Controller
{
    public function index()
    {
        // Ambil semua data yang memiliki status 'on going'
        $projects = Data::where('status', 'on going')->get(); 

        return view('pages.taskmanager', compact('projects')); 
    }
}
?>
