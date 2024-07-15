<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $averageCost = Cost::whereNotNull('cost')->avg('cost');

        $totalproduction = $totalproduction ?? 0;
        $totalcost = $totalcost ?? 0;
        $qty = $cost->sum("qty");

        $totalAdherence = $data->sum('adherence');
        $totalLead = $cost->sum('lead_time');

        $totalAdherence = $totalAdherence ?? 0;
        $totalLead = $totalLead ?? 0;

        $averageAdherence = $totalproduction != 0 ? $totalAdherence / $totalproduction : 0;
        $averageLead = $totalproduction != 0 ? $totalLead / $totalproduction : 0;

        $productionByMonth = Data::selectRaw('DATE_FORMAT(meeting, "%Y-%m") as month, COUNT(*) as total')
            ->groupByRaw('DATE_FORMAT(meeting, "%Y-%m")')
            ->get();

        $finishCount = Data::where('status', 'Finished')->count();
        $ongoingCount = Data::where('status', 'On Going')->count();
        $dropCount = Data::where('status', 'Drop')->count();

        $statusData = [$finishCount, $ongoingCount, $dropCount];
        $statusLabels = ['Finished', 'On Going', 'Drop'];
        $statusColors = ['#36DC56', '#FFA600', '#FF2525'];

        $decision = $this->evaluateProductionDecisionLogic($totalproduction, $totalcost, 4000, 400);

        return view("pages.dss", compact('qty', 'totalproduction', 'averageAdherence', 'totalLead', 'averageLead', 'averageCost', 'productionByMonth', 'statusData', 'statusLabels', 'statusColors', 'decision'));
    }

    public function evaluateProductionDecision(Request $request)
    {
        $totalToys = $request->input('totalToys');
        $months = $request->input('months');

        $decision = $this->evaluateProductionDecisionLogic($totalToys, $months);

        return response()->json(['decision' => $decision]);
    }


    private function evaluateProductionDecisionLogic($totalToys, $months)
    {
        // Retrieve data for the current year
        $thisYearData = Cost::whereYear('created_at', now()->year);

        // Calculate total quantity for the current year
        $totalProductionThisYear = $thisYearData->sum('qty');

        // Calculate total weighted labor cost and machine cost for the current year
        $totalLaborCostThisYear = $thisYearData->sum(DB::raw('labor * qty'));
        $totalMachineCostThisYear = $thisYearData->sum(DB::raw('cost * qty'));

        // Assumption: 1 labor can produce 50 units of production
        $productivityPerLabor = 50;
        // Assumption: 1 machine can handle 10 laborers
        $laborsPerMachine = 10;

        // Calculate the total number of laborers required based on productivity
        $totalLaborsRequired = ceil($totalProductionThisYear / $productivityPerLabor);

        // Calculate the total number of machines required based on the number of laborers
        $totalMachinesRequired = ceil($totalLaborsRequired / $laborsPerMachine);

        // Calculate the total cost considering the number of laborers and machines required
        $totalCostThisYear = ($totalLaborCostThisYear * $totalLaborsRequired) + ($totalMachineCostThisYear * $totalMachinesRequired);

        if ($totalCostThisYear == 0) {
            return "Unable to calculate efficiency. Total cost this year is zero.";
        }

        $efficiency = $totalProductionThisYear / $totalCostThisYear;

        // Calculate average costs per unit
        $averageLaborCostPerUnit = $totalLaborCostThisYear / $totalProductionThisYear;
        $averageMachineCostPerUnit = $totalMachineCostThisYear / $totalProductionThisYear;

        // Calculate total production cost for the given input
        $totalProductionCost = $totalToys * ($totalLaborCostThisYear / $totalProductionThisYear) * $months;

        // Calculate the projected total production for this year, considering the new addition
        $projectedTotalProductionThisYear = $totalProductionThisYear + $totalToys;
        $currentCapacity = 5000 * $months;  // Adjust capacity based on months
        $bufferCapacity = 500;

        // Calculate remaining capacity
        $remainingCapacity = $currentCapacity - $totalProductionThisYear + $bufferCapacity;

        // Check if the requested production is feasible given the current year's production rate
        if ($totalToys <= $remainingCapacity) {
            // Validate if totalToys is within the range of 10% to 20% of totalProductionThisYear
            $minToys = $totalProductionThisYear * 0.10; // 10% of totalProductionThisYear
            $maxToys = $totalProductionThisYear * 0.20; // 20% of totalProductionThisYear

            if ($totalToys < $minToys || $totalToys > $maxToys) {
                return "No, total toys should be between {$minToys} and {$maxToys} units.";
            }

            // Calculate additional labor and machines needed
            $additionalLaborNeeded = ceil($totalToys / $productivityPerLabor);
            $additionalMachinesNeeded = ceil($additionalLaborNeeded / $laborsPerMachine);

            // Compare additional labor needed with current labor available
            // $additionalLaborNeeded = max(0, $additionalLaborNeeded - $currentLabor);

            // Compare additional machines needed with current machines available
            // $additionalMachinesNeeded = max(0, $additionalMachinesNeeded - $currentMachines);

            if ($additionalLaborNeeded == 0 && $additionalMachinesNeeded == 0) {
                return "Yes, you should take the tender without adding any labor and machines.";
            } else {
                return "Yes, you should take the tender with additional labor: {$additionalLaborNeeded} and additional machines: {$additionalMachinesNeeded}";
            }
        } else {
            if ($months < 3 || ($totalToys + $totalProductionThisYear > $remainingCapacity)) {
                return "No, based on the total production, the current production plan does not meet the production goals.";
            } else {
                // Validate if totalToys is within the range of 10% to 20% of totalProductionThisYear
                $minToys = $totalProductionThisYear * 0.10; // 10% of totalProductionThisYear
                $maxToys = $totalProductionThisYear * 0.20; // 20% of totalProductionThisYear

                if ($totalToys < $minToys || $totalToys > $maxToys) {
                    return "No, total toys should be between {$minToys} and {$maxToys} units.";
                }

                // Calculate additional labor and machines needed
                $additionalLaborNeeded = ceil($totalToys / $productivityPerLabor);
                $additionalMachinesNeeded = ceil($additionalLaborNeeded / $laborsPerMachine);

                // Compare additional labor needed with current labor available
                // $additionalLaborNeeded = max(0, $additionalLaborNeeded - $currentLabor);

                // Compare additional machines needed with current machines available
                // $additionalMachinesNeeded = max(0, $additionalMachinesNeeded - $currentMachines);

                return "Yes, you should take the tender with additional labor: {$additionalLaborNeeded} and additional machines: {$additionalMachinesNeeded}";
            }
        }
    }


}
