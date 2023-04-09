<?php

namespace App\Http\Controllers;

use App\Models\mentor;
use Illuminate\Http\Request;

class mentorController extends Controller
{
    public function index(){
        $mentor = mentor::all();
        return response()->json($mentor);
    }
}
