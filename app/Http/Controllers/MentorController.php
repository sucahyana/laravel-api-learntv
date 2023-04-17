<?php

namespace App\Http\Controllers;

use App\Http\Resources\MentorResource;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MentorController extends Controller
{
    // MentorController.php


    public function index()
    {
        $mentors = Mentor::all();
        $mentorResource = MentorResource::collection($mentors);

        // Ambil hasil toArray()
        $responseData = $mentorResource->toArray(request());

        // Ubah urutan elemen dalam array
        $responseData = [
            'event' => 'List Mentor',
            'data' => $responseData
        ];

        // Kembalikan respons JSON
        return response()->json($responseData);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('mentors')->where(function ($query) use ($request) {
                    return $query->where('name', $request->input('name'))
                        ->where('category', $request->input('category'));
                }),
            ],
            'category' => 'required',
        ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // ubah response menjadi JSON dengan status code 422 untuk error validasi
        }

        $mentor = Mentor::create($request->all());

        return response()->json($mentor, 201);
    }


}
