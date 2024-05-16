<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\Cost;
use App\Models\Data;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;


// use App\Http\Controllers\ProjectListController;

class ProjectListController extends Controller
{
    public function projectlist(Request $request)
    {

        $selectedDesigner = $request->input('designer');

        $designers = Data::pluck('designer')->unique();


        $projectsQuery = Data::query();
        if ($selectedDesigner) {
            $projectsQuery->where('designer', $selectedDesigner);
        }


        $projects = $projectsQuery->where('status', '!==', 'Draft')->get();


        return view("pages.projectlist", compact('projects', 'designers'));
    }


    //     public function showProjectDetail($id)
    // {
    //     $project = Data::find($id);

    //     if (!$project) {
    //         return response()->json(['error' => 'Project not found'], 404);
    //     }
    //     //   dd($project);
    //     return view('pages.projectdetail', compact('project'));
    // }


    public function showProjectDetail($id)
    {
        $project = Data::with('cost')->find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return view('pages.projectdetail', compact('project'));
    }



    // public function showProjectDetail()
    // {
    //     return view('pages.projectdetail');
    // }



    public function newproject()
    {
        return view("pages.newproject");
    }

    public function draft(Request $request)
    {
        $selectedDesigner = $request->input('designer');

        $designers = Data::pluck('designer')->unique();
        $data = Data::where('status', 'on going')->get();

        $projectsQuery = Data::where('status', 'on going');
        if ($selectedDesigner) {
            $projectsQuery->where('designer', $selectedDesigner);
        }
        $data = $projectsQuery->get();
        return view("pages.draft", compact('data', 'designers'));
    }

    public function editProject($id)
    {
        $project = Data::with('cost')->find($id);
        return view('pages.editproject', compact('project', 'id'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'productID' => 'required',
            'toyName' => 'required',
            'pe' => 'required',
            'designer' => 'required',
            'category' => 'required',
            'description' => 'required',
            'qty' => 'nullable',
            'costbudget' => 'nullable',
            'meeting' => 'required|date',
            'start_date' => 'required|date',
            'finish_cmt' => 'required|date',
            'finish_act' => 'required|date',
            'remarks' => 'nullable',
            'delayreason' => 'nullable',
            'launchdate'=>'required|date',
            'status' => 'nullable',
        ]);

        $project = Data::findOrFail($id);


        $project->productID = $request->productID;
        $project->toyName = $request->toyName;
        $project->pe = $request->pe;
        $project->designer = $request->designer;
        $project->category = $request->category;
        $project->description = $request->description;
        $project->meeting = $request->meeting;
        $project->start_date = $request->start_date;
        $project->finish_cmt = $request->finish_cmt;
        $project->finish_act = $request->finish_act;
        $project->remarks = $request->remarks;
        $project->status = $request->status;



        if ($request->finish_act) {
            $project->status = 'Finished';
        }

        if ($request->finish_act && $request->finish_cmt) {
            $finishActDate = Carbon::parse($request->finish_act);
            $finishCmtDate = Carbon::parse($request->finish_cmt);
    
            if ($finishActDate->day == 31 && $finishCmtDate->day == 30) {
                $project->adherence = 0;
                
                $cost = Cost::where('id', $id)->first(); 
                if ($cost) {
                    $cost->lead_time = 18.00;
                    $cost->save();
                }
            }
        }
        $project->save();


        $cost = Cost::where('id', $id)->first();
        if ($cost) {
            $cost->assortment = $request->toyName;
            $cost->category = $request->category;
            $cost->material = $request->category;
            $cost->qty = $request->qty;
            $cost->cost = $request->costbudget;
            $cost->labor=$request->costbudget;
            $cost->delay_reason = $request->delayreason;
            $cost->remarks = $request->remarks;
            $cost->launch_avail = $request->launchdate;

            if($request->finish_act && $request->finish_cmt) {
                $finishActDate = Carbon::parse($request->finish_act);
                $finishCmtDate = Carbon::parse($request->finish_cmt);
                
                if($finishActDate->day==31 && $finishCmtDate->day== 30) {
                    $cost->lead_time = 18.00;
                }
            }

            $cost->save();
        }

        // dd($project);

        return redirect()->route('projectdetail', ['project' => $id])->with('success', 'Project updated successfully.');
    }

    public function projectdetail($id)
    {

        $project = Data::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        //   dd($project);
        return view('pages.projectdetail', compact('project'));
    }



    public function storeNewProject(Request $request)
    {
        $isDraft = $request->input('draft') == "1";

        $validatedData = $request->validate([
            'productID' => 'required',
            'toyName' => 'required',
            'pe' => 'required',
            'designer' => 'required',
            'category' => 'required',
            'description' => 'required',
            'meeting' => $isDraft ? 'nullable|date' : 'required|date',
            'start_date' => $isDraft ? 'nullable|date' : 'required|date',
            'finish_cmt' => $isDraft ? 'nullable|date' : 'required|date',
            'remarks' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
    
        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $images[] = $imageName;
            }
        }
        
   

        $projectID = rand(100000, 999999);
        $status = $request->input('draft') == "1" ? "Draft" : "On going";


        $startDate = new \DateTime($request->meeting_date);
        $finishCMT = new \DateTime($request->start_date);
        $interval = $startDate->diff($finishCMT);
        $months = $interval->m + ($interval->y * 12);

        $adherence = ($status === "Ongoing") ? 0 : null;

        Data::create([
            'projectID' => $projectID,
            'assortment' => $request->toyName,
            'productID' => $request->productID,
            'toyName' => $request->toyName,
            'pe' => $request->pe,
            'designer' => $request->designer,
            'category' => $request->category,
            'description' => $request->description,
            'meeting' => $request->meeting,
            'start_date' => $request->start_date,
            'finish_cmt' => $request->finish_cmt,
            'remarks' => $request->remarks,
            'status' => $status,
            'adherence' => $adherence,
            'month' => $months,
            'image' => json_encode($images),
        ]);

        Cost::create([
            'projectID' => $projectID,
            'assortment' => $request->toyName,
            'productID' => $request->productID,
            'category' => $request->category,
            'remarks' => $request->remarks,
            'material' => $request->category,
        ]);

        Alert::success('Success', 'Project Added!!');

        
        return redirect()->route('projectlist')->with('success', 'New project has been created successfully.');
    }


    // public function storeNewProject(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'productID' => 'required',
    //         'toyName' => 'required',
    //         'pe' => 'required',
    //         'designer' => 'required',
    //         'category' => 'required',
    //         'description' => 'required',
    //         'meeting' => 'required|date',
    //         'start_date' => 'required|date',
    //         'finish_cmt' => 'required|date',
    //         'remarks' => 'nullable', 
    //     ]);

    //     $imagePaths = [];
    //     if ($request->hasFile('image')) {
    //         foreach ($request->file('image') as $image) {
    //             $imageName = $image->getClientOriginalName();
    //             $imagePath = 'images/' . $imageName; 
    //             $image->move(public_path('images'), $imageName);
    //             $imagePaths[] = $imagePath;
    //         }
    //     }

    //     $projectID = rand(100000, 999999);
    //     $status = "On going";
    //     $startDate = new \DateTime($request->meeting_date);
    //     $finishCMT = new \DateTime($request->start_date);
    //     $interval = $startDate->diff($finishCMT);
    //     $months = $interval->m + ($interval->y * 12);
    //     $adherence = ($status === "Ongoing") ? 0 : null;

    //     $project = Data::create([
    //         'projectID' => $projectID,
    //         'assortment' => $request->toyName,
    //         'productID' => $request->productID,
    //         'toyName' => $request->toyName,
    //         'pe' => $request->pe,
    //         'designer' => $request->designer,
    //         'category' => $request->category,
    //         'description' => $request->description,
    //         'meeting' => $request->meeting,
    //         'start_date' => $request->start_date,
    //         'finish_cmt' => $request->finish_cmt,
    //         'remarks' => $request->remarks,
    //         'status' => $status,
    //         'adherence' => $adherence,
    //         'month' => $months,
    //         'image' => json_encode($imagePaths), 
    //     ]);


    //     Cost::create([
    //                 'projectID' => $projectID,
    //                 'assortment' => $request->toyName,
    //                 'productID' => $request->productID,
    //                 'category' => $request->category,
    //                 'remarks' => $request->remarks,
    //                 'material' => $request->category,
    //             ]);


    //             Alert::success('Success', 'Project Added!!');

    
    //                 return redirect()->route('projectlist')->with('success', 'New project has been created successfully.');

    // }


    public function submitNewProject(Request $request)
    {

        $this->storeNewProject($request);


        return redirect()->route('projectlist')->with('success', 'New project has been submitted successfully.');
    }

    public function redirectToProjectList($projectId)
    {
        return redirect()->route('projectlist')->with('projectId', $projectId);
    }

    public function displayProject()
    {
        $projects = Data::whereNotIn('status', ['Draft', 'Drop'])->get();

        return response()->json($projects);
    }



    public function dropProject($id)
    {

        $project = Data::find($id);


        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }


        $project->status = 'DROP';
        $project->save();


        if ($project->status !== 'DROP') {
            return redirect()->back()->with('error', 'Failed to drop project.');
        }


        return redirect()->route('projectdetail', ['project' => $id])->with('success', 'Project dropped successfully.');
    }


    public function delete($id)
    {
        $project = Data::findOrFail($id);
        $project->delete();

        Cost::where('id', $id)->delete();

        return redirect()->route('projectlist')->with('success', 'Project deleted successfully');
    }
}