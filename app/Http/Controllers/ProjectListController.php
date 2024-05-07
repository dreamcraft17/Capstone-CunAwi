<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\Data;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

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

        // $projects->transform(function ($project) {
        //     if (is_null($project->status)) {
        //         $project->status = " - ";
        //     }
        //     return $project;
        // });



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

    public function editProject($id)
{
    $project = Data::findOrFail($id);
    return view('pages.editproject', compact('project', 'id')); // Menambahkan variabel $id ke compact
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
        'meeting' => 'required|date',
        'start_date' => 'required|date',
        'finish_cmt' => 'required|date',
        'remarks' => 'nullable',
    ]);

    $project = Data::findOrFail($id);

    // Set nilai atribut berdasarkan data yang diterima dari request
    $project->productID = $request->productID;
    $project->toyName = $request->toyName;
    $project->pe = $request->pe;
    $project->designer = $request->designer;
    $project->category = $request->category;
    $project->description = $request->description;
    $project->meeting = $request->meeting;
    $project->start_date = $request->start_date;
    $project->finish_cmt = $request->finish_cmt;
    $project->remarks = $request->remarks;

    // Simpan perubahan ke database
    $project->save();

    // dd($project);
    // Redirect kembali ke halaman detail proyek dengan pesan sukses
    return redirect()->route('projectdetail', ['project' => $id])->with('success', 'Project updated successfully.');
}


    public function projectdetail($id){
        
        $project = Data::find($id);
    
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        //   dd($project);
        return view('pages.projectdetail', compact('project'));
    }


    
  


    
    // public function delete($project)
    // {
    //     $project = Data::findOrFail($project);
    //     $project->delete();

    //     return redirect()->route('projectlist')->with('success', 'Project deleted successfully');
    // }

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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Sebelum penyimpanan gambar
Log::info('Before saving image');

// Proses penyimpanan gambar
$image->move(public_path('img'), $imageName);

// Setelah penyimpanan gambar
Log::info('After saving image');
        }

        
        $projectID = rand(100000, 999999);
        $status = $request->input('draft') ? null : "On going";

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
            'image' => $imageName, 

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
        $projects = Data::whereNotNull('status')
                        ->where('status', '!=', 'DROP')
                        ->get();
    
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

    return redirect()->route('projectlist')->with('success', 'Project deleted successfully');
}

    
    


}


