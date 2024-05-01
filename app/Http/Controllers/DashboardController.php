<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $name = $user->name;
        $projectCount = Data::count();
        return view("pages.dashboard", ['name' => $name, 'projectCount' => $projectCount]);
    }
}
