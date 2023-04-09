<?php

namespace App\Http\Controllers;

use App\Models\videoMentor;
use Illuminate\Http\Request;

class videoMentorContrroller extends Controller
{
    public function vidMentor(){

        $videoMentor = videoMentor::all();
        return response()->json($videoMentor);
    }
}
