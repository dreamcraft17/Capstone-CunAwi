<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\Data;
use RealRashid\SweetAlert\Facades\Alert;
// use App\Http\Controllers\ProjectListController;

class ProjectListController extends Controller
{
    public function projectlist(Request $request){
        // Mendapatkan nilai dari dropdown select
        $selectedDesigner = $request->input('designer');
        $filterStatus = $request->query('status');

        // Mengambil data semua desainer
        $designers = Data::pluck('designer')->unique();
        $projects = $filterStatus ? Data::where('status', $filterStatus)->get() : Data::all();

        // Query untuk mendapatkan data berdasarkan nilai dropdown select
        $projectsQuery = Data::query();
        if($selectedDesigner){
            $projectsQuery->where('designer', $selectedDesigner);
        }
        $projects = $projectsQuery->get();

        // Mengirim data desainer dan data proyek ke tampilan
        return view("pages.projectlist", compact('projects', 'designers'));
    }

    public function showProjectDetail($id)
{
    $project = Data::find($id);

    if (!$project) {
        return response()->json(['error' => 'Project not found'], 404);
    }
    //   dd($project);
    return view('pages.projectdetail', compact('project'));
}


    // public function showProjectDetail()
    // {
    //     return view('pages.projectdetail');
    // }



     public function newproject(){
        return view("pages.newproject");
    }

    public function draft(Request $request){
        $selectedDesigner = $request->input('designer');

        $designers = Data::pluck('designer')->unique();
        $data = Data::where('status', 'on going')->get();

        $projectsQuery = Data::where('status', 'on going');
        if($selectedDesigner){
            $projectsQuery->where('designer', $selectedDesigner);
        }
        $data = $projectsQuery->get();
        return view("pages.draft",compact('data','designers'));
    }

    public function editproject(){
        return view("pages.editproject");
    }

    public function projectdetail($id){
        $project = Data::findOrFail($id);

        return view("pages.projectdetail", compact('project'));
    }

    public function dropproject(){
        return view("pages.dropproject");
    }

    public function delete($project)
    {
        $project = Data::findOrFail($project);
        $project->delete();

        return redirect()->route('projectlist')->with('success', 'Project deleted successfully');
    }

    public function storeNewProject(Request $request)
    {

        $validatedData = $request->validate([
            'productID' => 'required',
            'toyName' => 'required',
            'pe' => 'required',
            'designer' => 'required',
            'category' => 'required',
            'description' => 'required',
            'meeting' => 'required|date',
            'start_date' => 'required|date',
            'finish_cmt' => 'required|date',
            'remarks' => 'nullable',

        ]);

        $projectID = rand(100000, 999999);
        $status= "On going";

        $startDate = new \DateTime($request->meeting_date);
        $finishCMT = new \DateTime($request->start_date);
        $interval = $startDate->diff($finishCMT);
        $months = $interval->m + ($interval->y * 12);


        $adherence = ($status === "On going") ? 0 : null;

        Data::create([
            'projectID' => $projectID,
            'assortment' => $request->toyName,
            'productID' => $request->productID,
            'toyName' => $request->toyName,
            'pe'=> $request->pe,
            'designer'=> $request->designer,
            'category'=> $request->category,
            'description'=> $request->description,
            'meeting'=> $request->meeting,
            'start_date'=> $request->start_date,
            'finish_cmt'=> $request->finish_cmt,
            'remarks'=> $request->remarks,
            'status'=> $status,
            'adherence' => $adherence,
            'month' => $months,

        ]);

        Alert::success('Success', 'Project Added!!');
        return redirect()->route('projectlist')->with('success', 'New project has been created successfully.');
    }

    public function submitNewProject(Request $request){

        $this->storeNewProject($request);


        return redirect()->route('projectlist')->with('success', 'New project has been submitted successfully.');
    }

    public function redirectToProjectList($projectId){
        return redirect()->route('projectlist')->with('projectId', $projectId);
    }

    public function displayProject()
    {
        // Retrieve all projects from the Data model
        $projects = Data::all();

        // Return the projects as JSON
        return response()->json($projects);
    }




}


