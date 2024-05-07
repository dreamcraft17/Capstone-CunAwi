<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DropController extends Controller
{
    public function drop(Request $request)
    {
        $selectedDesigner = $request->input('designer');
        $designers = Data::pluck('designer')->unique();
        $data = Data::where('status','Drop')->get();

        $projectsQuery = Data::where('status','Drop');
        if( $selectedDesigner ) {
            $projectsQuery->where('designer',$selectedDesigner);
        }
        $data = $projectsQuery->get();

        return view("pages.dropproject",compact("data","designers"));
    }

    public function displaydrop(){
        $data = Data::where('status', 'Drop')->get();

        return response()->json($data);
    }
}
