<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Data;

class DraftController extends Controller
{
    public function draft(Request $request)
    {

        $selectedDesigner = $request->input('designer');

        $designers = Data::pluck('designer')->unique();
        $data = Data::where('status', null)->get();

        $projectsQuery = Data::where('status', null);
        if($selectedDesigner){
            $projectsQuery->where('designer', $selectedDesigner);
        }
        $data = $projectsQuery->get();



        return view("pages.draft",compact('data','designers'));
    }

    public function displaydraft(){
        $data = Data::where('status', 'Draft')->get();

        return response()->json($data);
    }
}
