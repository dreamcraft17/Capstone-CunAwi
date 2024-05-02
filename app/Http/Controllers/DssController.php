<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectListController;
use App\Http\Controllers\TaskManagerController;
use App\Http\Controllers\CalendarController;
use App\Models\Data;
use App\Models\Cost;


class DssController extends Controller
{
    public function index()
    {
        $data = Data::all();
        $cost = Cost::all();

        $totalproduction = $data->count();
        $totalcost = $cost->sum("cost");

        $totalAdherence = $data->sum('adherence');
        $totalLead = $data->sum('lead_time');
        $averageAdherence = $totalAdherence / $totalproduction;
        $averageLead = $totalLead / $totalproduction;
        $averageCost = $totalproduction / $totalcost;

        $productionByMonth = Data::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->get();

        $finishCount = Data::where('status', 'Finished')->count();
        $ongoingCount = Data::where('status', 'On Going')->count();
        $dropCount = Data::where('status', 'Drop')->count();

        // Data untuk digunakan dalam grafik
        $statusData = [$finishCount, $ongoingCount, $dropCount];
        $statusLabels = ['Finished', 'On Going', 'Drop'];
        $statusColors = ['#36DC56', '#FFA600', '#FF2525'];



        return view("pages.dss", compact('totalproduction', 'averageAdherence', 'totalLead', 'averageLead', 'averageCost', 'productionByMonth','statusData','statusLabels','statusColors'));
    }
}
