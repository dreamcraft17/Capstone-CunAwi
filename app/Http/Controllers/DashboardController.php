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

        $productionByMonth = Data::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
        ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
        ->get();

    $finishCount = Data::where('status', 'Finished')->count();
    $ongoingCount = Data::where('status', 'On Going')->count();
    $dropCount = Data::where('status', 'Drop')->count();

    
    $statusData = [$finishCount, $ongoingCount, $dropCount];
    $statusLabels = ['Finished', 'On Going', 'Drop'];
    $statusColors = ['#36DC56', '#FFA600', '#FF2525'];

    $totalfinish = ($projectCount != 0) ? (($finishCount / $projectCount) * 100) : 0;
    $totalongoing = ($projectCount != 0) ? (($ongoingCount / $projectCount) * 100) : 0;
    $totaldrop = ($projectCount != 0) ? (($dropCount / $projectCount) * 100) : 0;       


        return view("pages.dashboard", ['name' => $name, 'projectCount' => $projectCount], compact('productionByMonth','statusData','statusLabels','statusColors','totalfinish','totalongoing','totaldrop'));
    }
}
