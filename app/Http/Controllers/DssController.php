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

        $totalproduction = $totalproduction ?? 0;
        $totalcost = $totalcost ?? 0;

        $totalAdherence = $data->sum('adherence');
        $totalLead = $data->sum('lead_time');

        $totalAdherence = $totalAdherence ?? 0;
        $totalLead = $totalLead ?? 0;

        $averageAdherence = $totalproduction != 0 ? $totalAdherence / $totalproduction : 0;
        $averageLead = $totalproduction != 0 ? $totalLead / $totalproduction : 0;
        $averageCost = $totalcost != 0 ? $totalproduction / $totalcost : 0;

        $productionByMonth = Data::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->get();

        $finishCount = Data::where('status', 'Finished')->count();
        $ongoingCount = Data::where('status', 'On Going')->count();
        $dropCount = Data::where('status', 'Drop')->count();

        
        $statusData = [$finishCount, $ongoingCount, $dropCount];
        $statusLabels = ['Finished', 'On Going', 'Drop'];
        $statusColors = ['#36DC56', '#FFA600', '#FF2525'];

        $decision = $this->evaluateProductionDecisionLogic($totalproduction, $totalcost);

        return view("pages.dss", compact('totalproduction', 'averageAdherence', 'totalLead', 'averageLead', 'averageCost', 'productionByMonth', 'statusData', 'statusLabels', 'statusColors', 'decision'));
    }


    public function evaluateProductionDecision(Request $request)
    {
        $totalToys = $request->input('totalToys');
        $months = $request->input('months');

        $decision = $this->evaluateProductionDecisionLogic($totalToys, $months);

        return $decision;
    }
    // private function evaluateProductionDecisionLogic($totalToys, $months)
    // {

    //     $lastYearData = Cost::whereYear('created_at', now()->subYear()->year)->get();


    //     $totalProductionLastYear = $lastYearData->count();
    //     $totalLaborCostLastYear = $lastYearData->sum('labor');
    //     $totalMachineCostLastYear = $lastYearData->sum('cost');
    //     $totalCostLastYear = $totalLaborCostLastYear + $totalMachineCostLastYear;


    //     $efficiency = $totalProductionLastYear / $totalCostLastYear;


    //     $totalProductionCost = $totalToys * ($totalLaborCostLastYear / $totalProductionLastYear) * $months;


    //     if ($totalProductionCost < $efficiency) {

    //         return "Suggesstion : Add the labors";
    //     } else {

    //         if ($totalMachineCostLastYear < ($totalCostLastYear * 0.3)) {
    //             return "Suggesstion : Add Machine";
    //         } else {
    //             return "suggesstion : add machine and labor";
    //         }
    //     }
    // }

    private function evaluateProductionDecisionLogic($totalToys, $months)
    {
    
        $thisYearData = Cost::whereYear('created_at', now()->year)->get();
    
        $totalProductionThisYear = $thisYearData->count();
        $totalLaborCostThisYear = $thisYearData->sum('labor');
        $totalMachineCostThisYear = $thisYearData->sum('cost');
        $totalCostThisYear = $totalLaborCostThisYear + $totalMachineCostThisYear;
    
        if ($totalCostThisYear == 0) {
            return "Unable to calculate efficiency. Total cost this year is zero.";
        }
    
        $efficiency = $totalProductionThisYear / $totalCostThisYear;
    
        $totalProductionCost = $totalToys * ($totalLaborCostThisYear / $totalProductionThisYear) * $months;
    
        if ($totalProductionCost < $efficiency) {
            return "Suggestion: Add labor.";
        } else {
            if ($totalMachineCostThisYear < ($totalCostThisYear * 0.3)) {
                return "Suggestion: Add Machine.";
            } else {
                return "Suggestion: Add machine and labor.";
            }
        }
    }
    
}
