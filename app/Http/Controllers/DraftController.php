<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Data;

class DraftController extends Controller
{
    public function index()
    {
        
        $data = Data::where('status', 'on going')->get();

        
        return response()->json($data);
    }
}
